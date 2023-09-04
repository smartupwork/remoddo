<?php

namespace App\Service\Admin\Datatable;

use Yajra\DataTables\DataTables;

class OrderDatatable implements DatatableInterface
{

    public static function makeEntityList($query, ?int $id = null)
    {
        return DataTables::of($query::query()->with('lender', 'renter',))
            ->editColumn('date', function ($model) {
                return $model->created_at->format('d.m.Y');
            })
            ->editColumn('status', function ($model) {
                return view('components.admin.order.status', [
                    'status' => $model->status
                ]);
            })
            ->addColumn('product', function ($model) {
                return $model->product->title;
            })
            ->addColumn('invoice', function ($model) {
                return 0;
            })
            ->addColumn('lender', function ($model) {
                return $model->lender->info->full_name;
            })
            ->addColumn('renter', function ($model) {
                return $model->renter->info->full_name;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'orders',
                    'actions' => ['show']
                ])->render();
            })->filter(function ($model) {
                $model->when(request()->get('status'), function ($query) {
                    $query->where('status', request()->get('status'));
                })->when(request()->get('products'), function ($query) {
                    $query->whereIn('product_id', request()->get('products'));
                })->when(request()->get('renters'), function ($query) {
                    $query->whereIn('renter_id', request()->get('renters'));
                })->when(request()->get('lenders'), function ($query) {
                    $query->whereIn('lender_id', request()->get('lenders'));
                })->when(request()->get('brands'), function ($query) {
                    $query->whereHas('product', function ($query) {
                        $query->whereIn('brand_id', request()->get('brands'));
                    });
                })->when(request()->get('date_range'), function ($query) {
                    $start = request()->get('date_range')['startDate'];
                    $end = request()->get('date_range')['endDate'];
                    $query->when($start !== $end, function ($query) use ($start, $end) {
                        $query->whereBetween('created_at', [$start, $end]);
                    });
                });
            })
            ->rawColumns(['products_count', 'action', 'status'])
            ->make(true);
    }
}
