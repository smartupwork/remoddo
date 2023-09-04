<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class DisputeCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function dataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('id', function ($model) {
                return $model->id;
            })
            ->addColumn('title', function ($model) {
                return $model->title;
            })
            ->addColumn('description', function ($model) {
                return $model->description;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'problems'
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
