<?php

namespace App\Http\Controllers\Main\Profile;

use App\DTO\Main\UserUpdateDetailDTO;
use App\DTO\Main\UserUpdatePasswordDTO;
use App\Enums\NotificationType;
use App\Enums\OrderStatus;
use App\Enums\UserType;
use App\Events\SendNotificationEvent;
use App\Handler\Command\Main\User\UpdateDetailHandler;
use App\Handler\Command\Main\User\UpdatePasswordHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\UserUpdateDetailRequest;
use App\Http\Requests\Main\UserUpdatePasswordRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\SupportAgent;
use App\Models\User;
use App\Utils\Sorting\Order\LendingSorting;
use App\Utils\Sorting\Order\RentalSorting;
use App\Utils\Sorting\Order\RequestSorting;
use App\Utils\Sorting\OrderSorting;
use App\Utils\Sorting\ProductSorting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function request;

class UserController extends Controller
{
    private HandlerService $handlerService;
    private OrderSorting $orderSorting;

    public function __construct(HandlerService $handlerService, OrderSorting $orderSorting)
    {
        $this->handlerService = $handlerService;
        $this->orderSorting = $orderSorting;
    }


    public function likes()
    {
        [$column, $sort] = (new ProductSorting())->sorting(request()->get('sort'));
        $likeProducts = auth()->user()
            ->likes()->orderBy($column, $sort)
            ->paginate(config('model_pagination.product.per_page'))
            ->withQueryString();
        return view('main.pages.profile.user.likes', compact('likeProducts'));
    }

    public function rentals(Request $request)
    {
        [$column, $sort] = (new RentalSorting())->sorting(request()->get('sort'));
        $orders = Order::where('renter_id', auth()->user()->id)->with(['lender.rates'])
            ->filterBy($request->all())
            ->orderByRaw("$column $sort")
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();
        return view('main.pages.profile.user.rentals', compact('orders'));
    }

    public function detail()
    {
        $user = auth()->user();
        return view('main.pages.profile.user.detail', compact('user'));
    }

    public function updateDetail(UserUpdateDetailRequest $request, UserUpdateDetailDTO $dto)
    {
        $data = $dto->make($request);

        $handler = $this->handlerService
            ->setHandler(new UpdateDetailHandler)
            ->getHandler();
        $handler->setModel(User::find(auth()->user()->id))->setDTO($data)->handle();

        return $this->jsonSuccess('User Detail updated');
    }

    public function updatePassword(UserUpdatePasswordRequest $request, UserUpdatePasswordDTO $dto)
    {
        $data = $dto->make($request);

        $handler = $this->handlerService
            ->setHandler(new UpdatePasswordHandler)
            ->getHandler();
        $handler->setModel(User::find(auth()->user()->id))->setDTO($data)->handle();
        return $this->jsonSuccess('User Password updated');
    }

    public function paymentMethods()
    {
        return view('main.pages.profile.user.payments_methods');
    }

    public function changeSideBar(string $role)
    {
        $selected_role = 'renter';
        $url=route('main.profile.user.rentals');

        if ($role === UserType::RENTER) {
            $selected_role = 'lender';
            $url=route('main.profile.lender.overview');
        }

        request()->session()->put('user_role', $selected_role);


        return $this->jsonSuccess('Sidebar changed', [
            'url' => $url
        ]);
    }

    public function lending(Request $request)
    {
        [$column, $sort] = (new LendingSorting())->sorting($request->get('sort'));
        $orders = Order::with(['renter'])
            ->filterBy($request->all())
            ->where('renter_id', auth()->user()->id)
            ->orderByRaw("$column $sort")
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();
        return view('main.pages.profile.lender.lending', compact('orders'));
    }

    public function sendBack(Order $order)
    {
        $order->status = OrderStatus::SHIPPED_BACK;
        $order->save();

        $renter_context = "Your order #{$order->id} has been returned.";

        event(new SendNotificationEvent(
            model: $order,
            receiver_id: $order->lender_id,
            context: $renter_context,
            type: NotificationType::RETURNED,
            url: route('main.profile.lender.order-detail', $order)
        ));

        $lender_context = "Renter on order #{$order->id} have sent you order back, please check if he sent you postal code in the chat. If yes, confirm it by click on the button 'confirm postal code receipt'  in Order Details Page";

        event(new SendNotificationEvent(
            model: $order,
            receiver_id: $order->lender_id,
            context: $lender_context,
            type: NotificationType::SEND_BACK_NOTIFY,
            url: route('main.profile.lender.order-detail', $order)
        ));

        return $this->jsonSuccess('', [
            'url' => route('main.profile.chat.edit', $order)
        ]);
    }

    public function supportAgentStatus()
    {
        $this_user = SupportAgent::find(auth()->id());
        $this_user->statusJob->status_job = !$this_user->statusJob->status_job;
        $this_user->statusJob->save();
        return redirect()->back();
    }

}
