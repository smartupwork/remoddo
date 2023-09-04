<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'menus';

    public static function findByCode($code)
    {
        return self::where('code', $code)->with('items')->firstOrFail();
    }

    public static function dataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'menus',
                    'actions' => ['edit']
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('sort');
    }

    public function itemsAll()
    {
        return $this->hasMany(MenuItem::class)->orderBy('sort');
    }
}
