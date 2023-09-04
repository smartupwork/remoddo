<?php

namespace App\Service\Admin\Datatable;

use Yajra\DataTables\DataTables;

class HelpCenterCategoryDatatable implements DatatableInterface
{

    public static function makeEntityList($query, ?int $id = null)
    {
        return DataTables::of($query->withCount('questions'))
            ->editColumn('date', function ($model) {
                return $model->created_at;
            })
            ->addColumn('questions_count', function ($model) {
                return $model->questions_count;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'help-center-category'
                ])->render();
            })
            ->rawColumns(['questions_count', 'action'])
            ->make(true);
    }
}
