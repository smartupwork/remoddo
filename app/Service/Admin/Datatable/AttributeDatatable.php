<?php

namespace App\Service\Admin\Datatable;

use Yajra\DataTables\DataTables;

class AttributeDatatable implements DatatableInterface
{


    public static function makeEntityList($query, ?int $id = null)
    {
        return DataTables::of($query->withCount('values'))
            ->editColumn('date', function ($model) {
                return $model->created_at;
            })
            ->addColumn('values_count', function ($model) {
                return "<a href='" . route('admin.attributes.values.index',
                        ['attribute' => $model->id]) . "'>Values($model->values_count)</a>";
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'attributes'
                ])->render();
            })
            ->rawColumns(['values_count', 'action'])
            ->make(true);
    }
}
