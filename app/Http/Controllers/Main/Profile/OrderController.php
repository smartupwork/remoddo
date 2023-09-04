<?php

namespace App\Http\Controllers\Main\Profile;

use App\DTO\Main\UpdateOrderStatusDTO;
use App\Handler\Command\Main\Rent\CreatePaymentHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\UpdateOrderStatusRequest;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    private HandlerService $handlerService;
    private UpdateOrderStatusDTO $dto;

    public function __construct(HandlerService $handlerService, UpdateOrderStatusDTO $dto)
    {
        $this->handlerService = $handlerService;
        $this->dto = $dto;
    }


    public function changeStatus(Order $order, UpdateOrderStatusRequest $request)
    {
        try {
            $dto = $this->dto->make($request);
            $handler = $this->handlerService->setHandler(new CreatePaymentHandler)->getHandler();
            $handler->setModel($order)->setDTO($dto)->handle();
            return $this->jsonSuccess('', [
                'url' => route('main.profile.lender.requests')
            ]);
        } catch (Exception $exception) {
            Log::channel('order')->error($exception->getMessage());
            return $this->jsonError('something is wrong');
        }
    }

    public function lenderByOrder(Order $order)
    {
        $lender=$order->lender;
        return $this->jsonSuccess('',[
            'rating'=>$lender->rating,
            'avatar'=>$lender->info->avatar,
            'full_name'=>$lender->info->name,
            'rating_url'=>route('main.profile.user.rating-add',$order)
        ]);
    }

    public function popUpDetail(Order $order)
    {
        $product=$order->product;
        return $this->jsonSuccess('',[
            'product'=>[
                'name'=>$product->title,
                'brand'=>$product->brand->title,
                'image'=>$product->image,
                'url'=>route('main.product.detail',$product)
            ]
        ]);
    }
}
