<?php

namespace App\Http\Controllers\Main\Profile;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\TodoRequest;
use App\Models\Order;
use App\Models\ProductView;
use App\Models\Todo;
use App\Utils\DateRangeFilter;
use App\Utils\Sorting\Order\LendingSorting;
use App\Utils\Sorting\Order\RequestSorting;
use App\Utils\Sorting\OrderSorting;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;


class LenderController extends Controller
{
    private DateRangeFilter $dateRangeFilter;
    private OrderSorting $orderSorting;
    private StripeClient $stripe;

    public function __construct(DateRangeFilter $dateRangeFilter, OrderSorting $orderSorting)
    {
        $this->dateRangeFilter = $dateRangeFilter;
        $this->orderSorting = $orderSorting;
        $this->stripe = new StripeClient(config('cashier.secret'));
    }


    public function overview(Request $request)
    {
        $selectedDay = $request->get('range') ?? '1 day';

        $dateRangeFilter = $this->dateRangeFilter->setStartDate($selectedDay);

        $myRequests = $dateRangeFilter->filter(auth()->user()->myRequests());
        $myProducts = $dateRangeFilter->filter(auth()->user()->products());
        $chart = $dateRangeFilter->filter(auth()->user()->myRequests()
            ->selectRaw("DATE_FORMAT(`created_at`,'%d %M') as DATE, SUM(`total_price`) total_sum")
        )->groupBy('DATE')
            ->pluck('total_sum', 'DATE')
            ->toArray();

        $todos = $dateRangeFilter->filter(auth()->user()->todos())->get();
        $productsView = $dateRangeFilter->filter(ProductView::whereHas('product', function ($query) {
            $query->where('lender_id', auth()->user()->id);
        }));
        $orderCount = $myRequests->count();
        $productsViewCount = $productsView->count();
        $ordersRevenue = $myRequests
            ->where('status', OrderStatus::ACCEPTED)
            ->pluck('total_price')->sum();
        $bestPerforms = $myProducts->withCount('views')->with(['images', 'brand'])
            ->whereHas('views')
            ->limit(3)->get()->sortByDesc(function ($model) {
                return $model->views_count;
            });

        if (count($chart) == 1) {
            $chart[''] = '';
        }


        $chart_labels = array_keys($chart);

        sort($chart_labels);
        $chart_labels = join(',', $chart_labels);
        $chart_values = join(',', array_values($chart));

         $idsProductUser= auth()->user()->products()->pluck('id');

         // за последние 5 часов
        $JustNowproductsView = ProductView::whereIn('product_id',$idsProductUser)->where('created_at','>',Carbon::now()->subMinutes(5))->count();


        return view('main.pages.profile.lender.overview', compact(
            'orderCount', 'productsViewCount','JustNowproductsView',
            'ordersRevenue', 'bestPerforms', 'selectedDay', 'todos',
            'chart_labels', 'chart_values'
        ));
    }

    public function requests(Request $request)
    {
        [$column,$sort]=(new RequestSorting())->sorting($request->get('sort'));
        $orders = Order::where('lender_id', auth()->user()->id)->with(['product', 'renter.rates'])
            ->filterBy($request->all())
            ->orderBy($column,$sort)
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();
        return view('main.pages.profile.lender.requests', compact('orders'));
    }

    public function addTodo(TodoRequest $request)
    {
        $todo = auth()->user()->todos()->create([
            'title' => $request->title
        ]);
        return $this->jsonSuccess('', [
            'todo' => $todo
        ]);
    }
    public function removeTodo(Todo $todo)
    {
        if (auth()->user()->todos()->find($todo->id))
        {
            $todo->delete();
            return $this->jsonSuccess('Successfully deleted');
        }else{
            return $this->jsonError('this task does not belong to you', [
                'todo' => $todo
            ]);
        }
    }

    public function updateTodoStatus(Todo $todo)
    {
        $todo->update([
            'is_done' => !$todo->is_done
        ]);
        return $this->jsonSuccess('todo updated');
    }

    public function lending(Request $request)
    {
        [$column,$sort]=(new LendingSorting())->sorting($request->get('sort'));
        $orders = Order::with(['renter'])
            ->filterBy($request->all())
            ->where('lender_id', auth()->user()->id)
            ->where('status', OrderStatus::ACCEPTED)
            ->orderByRaw("$column $sort")
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();
        return view('main.pages.profile.lender.lending', compact('orders'));
    }

    public function stats(Request $request)
    {
        $selectedDay = $request->get('range') ?? '1 day';
        $dateRangeFilter = $this->dateRangeFilter->setStartDate($selectedDay);
        $myRequests = $dateRangeFilter->filter(auth()->user()->myRequests());
        $chart = $dateRangeFilter->filter(auth()->user()->myRequests()
            ->selectRaw("DATE_FORMAT(`created_at`,'%d %M') as DATE, SUM(`total_price`) total_sum")
        )->where('status', OrderStatus::ACCEPTED)
            ->groupBy('DATE')
            ->pluck('total_sum', 'DATE')
            ->toArray();


        $productsView = $dateRangeFilter->filter(ProductView::with(['product' => function ($query) {
            return $query->where('lender_id', auth()->user()->id);
        }]));

        $orderCount = $myRequests->count();
        $productsViewCount = $productsView->count();
        $ordersRevenue = $myRequests
            ->where('status', OrderStatus::ACCEPTED)
            ->pluck('total_price')->sum();
        if (count($chart) == 1) {
            $chart[''] = '';
        }


        $chart_labels = array_keys($chart);

        sort($chart_labels);
        $chart_labels = join(',', $chart_labels);
        $chart_values = join(',', array_values($chart));
        $myProducts = $dateRangeFilter->filter(auth()->user()->products());


        $rented_count = $myRequests->selectRaw('count(product_id)')->groupBy('product_id')->count();
        $product_relation=auth()->user()->products();
        DB::enableQueryLog();
        $active_product_count = $product_relation
            ->whereHas('rents')
            ->where(function ($query){
                $query->whereRaw("exists(select o.product_id from orders o where o.product_id=products.id AND
        o.exp_date>=now())=0");
            })
            ->count('id');

        $idsProductUser= auth()->user()->products()->pluck('id');
        // за последние 5 часов
        $JustNowproductsView = ProductView::whereIn('product_id',$idsProductUser)->where('created_at','>',Carbon::now()->subMinutes(5))->count();

        // за неделю
//        $JustNowproductsView = ProductView::whereIn('product_id',$idsProductUser)->where('created_at','>',Carbon::now()->subWeek())->count();

        $wardrobes = $myProducts->withCount(['views', 'orders'])->with('images')
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();
        return view('main.pages.profile.lender.stats', compact(
            'orderCount', 'productsViewCount','JustNowproductsView',
            'ordersRevenue', 'selectedDay',
            'chart_labels', 'chart_values', 'wardrobes', 'rented_count', 'active_product_count'
        ));
    }


    public function finance()
    {

        $month_date = Carbon::now()->subMonth()->format('Y-m-d');

        $orders = Order::with(['renter.info'])
            ->where('lender_id', auth()->user()->id);
        $order_count = $orders->count();

        $payment_history = $orders->where('status', OrderStatus::NEW)
            ->paginate(config('model_pagination.product.per_page'));

        $confirmed_orders = $orders->where('status', OrderStatus::ACCEPTED);

        $total_earning = $confirmed_orders->sum('total_price');
        $monthly_earning = $confirmed_orders->where('created_at', '>=', $month_date)->sum('total_price');

        $transaction_history = $confirmed_orders
            ->paginate(config('model_pagination.product.per_page'));

        $current_balance = auth()->user()->user_balance;

        $stripeAccount = auth()->user()->stripeAccount;
        $account_name = null;
        if ($stripeAccount) {
            $account = $this->stripe->accounts->retrieve(
                $stripeAccount->account_id, []
            );
            $external_account = $account->external_accounts->data[0];
            $account_name = $external_account->account_holder_name ?? "•••• •••• •••• $external_account->last4";
        }


        return view('main.pages.profile.lender.finance', compact(
            'payment_history',
            'transaction_history',
            'order_count', 'total_earning', 'current_balance', 'monthly_earning', 'account_name'
        ));
    }

    public function orderDetail(Order $order)
    {
        return view('main.pages.profile.order.detail', compact('order'));
    }

    public function orderPrint(Order $order)
    {
        $pdf = Pdf::loadView('pdf.main.order.invoice', compact('order'));
        // download PDF file with download method
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return $pdf->download("invoice-$now.pdf");
    }

    public function orderCompleted(Order $order)
    {
        $order->status=OrderStatus::COMPLETED;
        $order->save();

        $price = $order->deposit_price;

        $renter = $order->renter;

        $renter->balance()->updateOrCreate([
            'user_id' => $renter->id
        ], [
                'amount' => $renter->user_balance + $price
            ]
        );

        return redirect()->route('main.profile.lender.order-detail',$order);
    }


    public function confirmShipped(Order $order)
    {
        $order->status=OrderStatus::CONFIRM_SHIPPED_BACK;
        $order->save();
        return redirect()->route('main.profile.lender.order-detail',$order);
    }

}
