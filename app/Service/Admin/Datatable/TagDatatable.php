<?php

namespace App\Service\Admin\Datatable;

use Yajra\DataTables\DataTables;

class TagDatatable implements DatatableInterface
{

    public static function makeEntityList($query, ?int $id = null)
    {
        return DataTables::of($query::query())
            ->editColumn('date', function ($model) {
                return $model->created_at;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'tags'
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
