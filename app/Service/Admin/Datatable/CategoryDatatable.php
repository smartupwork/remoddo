<?php

namespace App\Service\Admin\Datatable;

use Yajra\DataTables\DataTables;

class CategoryDatatable implements DatatableInterface
{

    public static function makeEntityList($query, ?int $id = null)
    {

        return DataTables::of($query::query()
            ->withCount('products')
            ->when($id, function ($query) use ($id) {
                $query->where('parent_id', $id);
            })->when(!$id, function ($query) use ($id) {
                $query->whereNull('parent_id');
            })
        )
            ->editColumn('date', function ($model) {
                return $model->created_at;
            })
            ->addColumn('products_count', function ($model) {
                return $model->products_count;
            })
            ->addColumn('action', function ($model) use ($id) {
                return view('components.admin.actions', [
                    'model' => isset($id) ? ['category' => $id, $model] : $model,
                    'name' => isset($id) ? 'categories.children' : 'categories',
                    'parent' => !isset($id)
                        ? route('admin.categories.children.index', ['category' => $model->id])
                        : null
                ])->render();
            })
            ->rawColumns(['products_count', 'action'])
            ->make(true);
    }
}
