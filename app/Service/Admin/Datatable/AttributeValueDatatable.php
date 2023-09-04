<?php


namespace App\Service\Admin\Datatable;

use Yajra\DataTables\DataTables;

class AttributeValueDatatable implements DatatableInterface
{


    public static function makeEntityList($query, ?int $id = null)
    {

        return DataTables::of($query)
            ->addColumn('attribute', function ($model) {
                return $model->attribute->title;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => ['attribute' => $model->attribute->id, 'value' => $model->id],
                    'name' => 'attributes.values'
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
