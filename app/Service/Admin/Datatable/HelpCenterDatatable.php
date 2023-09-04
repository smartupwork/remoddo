<?php

namespace App\Service\Admin\Datatable;

use Yajra\DataTables\DataTables;

class HelpCenterDatatable implements DatatableInterface
{

    public static function makeEntityList($query, ?int $id = null)
    {
        return DataTables::of($query->with('category'))
            ->editColumn('date', function ($model) {
                return $model->created_at;
            })
            ->addColumn('category', function ($model) {
                return $model->category->title;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'help-center',
                    'actions'=>['edit']
                ])->render();
            })
            ->rawColumns(['category', 'action'])
            ->make(true);
    }
}
