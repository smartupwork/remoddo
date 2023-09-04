<?php

namespace App\Service\Admin\Datatable;

use App\Models\Attribute;
use Yajra\DataTables\DataTables;

class RenterProductDatatable implements DatatableInterface
{


    public static function makeEntityList($query, ?int $id = null)
    {
        $attributes = Attribute::where('show_in_products_table', true)->get();

        $datatable = DataTables::of($query
            ->with(['product.brand', 'product.values'])
            ->whereHas('product.attributes')
        )->addColumn('title', function ($model) {
            return $model->product->title;
        })->addColumn('brand', function ($model) {
            return $model->product->brand->title;
        });
        foreach ($attributes as $attribute) {
            $datatable->addColumn($attribute->name, function ($model) use ($attribute) {
                $values = $model->product->values->where('attribute_id', '=', $attribute->id)->pluck('value');

                return $values->join(' | ');
            });
        }

        $datatable->addColumn('violation', function ($model) {
            return "";
        })->addColumn('period', function ($model) {
            return $model->dateRangePicker;
        })->addColumn('paid_amount', function ($model) {
            return $model->total_price;
        })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'products'
                ])->render();
            })
            ->rawColumns(['action', 'violation']);
        return $datatable->make(true);
    }
}
