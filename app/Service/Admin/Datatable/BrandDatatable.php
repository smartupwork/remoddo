<?php

namespace App\Service\Admin\Datatable;

use App\Models\Brand;
use Yajra\DataTables\DataTables;

class BrandDatatable implements DatatableInterface
{
    /**
     * @param Brand $model
     */
    public static function makeEntityList($query, ?int $id = null)
    {
        return DataTables::of($query->withCount('products'))
            ->editColumn('date', function ($model) {
                return $model->created_at;
            })
            ->addColumn('products_count', function ($model) {
                return $model->products_count;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'brands'
                ])->render();
            })
            ->rawColumns(['products_count', 'action'])
            ->make(true);
    }
}
