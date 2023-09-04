<?php

namespace App\Service\Admin\Datatable;

use Yajra\DataTables\DataTables;

class ProductRenterDatatable implements DatatableInterface
{

    public static function makeEntityList($query, ?int $id = null)
    {
        return DataTables::of($query->with('renter'))
            ->addColumn('renter', function ($model) {
                return $model->renter->info->full_name;
            })->addColumn('period', function ($model) {
                return $model->dateRangePicker;
            })->addColumn('violation', function ($model) {
                return "";
            })->addColumn('total_paid', function ($model) {
                return $model->total_price;
            })
            ->make(true);
    }
}
