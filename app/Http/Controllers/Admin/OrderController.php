<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOrderStatusRequest;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Service\Admin\Datatable\OrderDatatable;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::where('is_show', true)->pluck('title', 'id');
        $users = User::with('info')->get();
        $products = Product::pluck('title', 'id');

        $orderStatuses = OrderStatus::asSelectArray();


        if (!$request->ajax()) {
            return view('admin.sections.orders.index', compact(
                'brands', 'users', 'products', 'orderStatuses'
            ));
        }
        return OrderDatatable::makeEntityList(new Order());
    }


    public function show(Order $order)
    {
        $statuses = OrderStatus::asSelectArray();
        return view('admin.sections.orders.show', compact('order', 'statuses'));
    }


    public function update(Order $order, UpdateOrderStatusRequest $request)
    {
        $order->status = $request->get('status');
        $order->save();
        return redirect()->route('admin.orders.show', $order);
    }
}
