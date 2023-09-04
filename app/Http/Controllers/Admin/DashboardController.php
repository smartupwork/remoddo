<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BrandConfirmationStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Lender;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\Renter;
use App\Models\User;
use App\Service\Admin\Datatable\ProductDatatable;
use App\Utils\DateRangeFilter;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    private DateRangeFilter $dateRangeFilter;

    public function __construct(DateRangeFilter $dateRangeFilter)
    {
        $this->dateRangeFilter = $dateRangeFilter;
    }


    public function index(Request $request)
    {
        $dateRangeFilter = $this->dateRangeFilter->setStartDate('month');

        $orders = Order::where('status', OrderStatus::ACCEPTED);
        $users = User::with('orders');
        $products = Product::with(['brand', 'attributes']);

        if ($request->ajax()) {
            return ProductDatatable::makeEntityList(Product::customSelected()
                ->where('brand_confirmation', BrandConfirmationStatus::PENDING)->limit(3));
        }

        $lastOrders = $this->dateRangeFilter->filter($orders)
            ->with(['product', 'product.brand', 'product.attributes'])
            ->limit(7)->orderByDesc('id')->get();


        $order_count = $orders->count();
        $order_revenue = $orders->sum('total_price');
        $view_count = ProductView::select('id')->count();
        $user_count = $users->count();

        $lenders = Lender::with(['myRequests' => function ($query) use ($dateRangeFilter) {
            return $dateRangeFilter->filter($query)
                ->where('status', OrderStatus::ACCEPTED);
        }])->orderByDesc('id')->limit(3)->get();


        $renters = Renter::with(['rentals' => function ($query) use ($dateRangeFilter) {
            return $dateRangeFilter->filter($query)
                ->where('status', OrderStatus::ACCEPTED);
        }])->orderByDesc('id')->limit(3)->get();


        $attributes = Attribute::where('show_in_products_table', true)->get();

        $chart = $dateRangeFilter->filter(Order::selectRaw(
            "DATE_FORMAT(`created_at`,'%d %M') as DATE, SUM(`total_price`) total_sum")
        )->groupBy('DATE')
            ->pluck('total_sum', 'DATE')
            ->toArray();
        if (count($chart) == 1) {
            $chart[''] = '';
        }


        $chart_labels = array_keys($chart);

        sort($chart_labels);
        $chart_labels = join(',', $chart_labels);
        $chart_values = join(',', array_values($chart));


        return view('admin.sections.dashboard.index', compact(
            'order_count', 'order_revenue',
            'view_count', 'user_count', 'lenders', 'renters',
            'attributes', 'lastOrders', 'chart_labels', 'chart_values'
        ));
    }
}
