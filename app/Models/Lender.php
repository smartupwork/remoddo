<?php


namespace App\Models;


use App\Enums\OrderStatus;
use App\Enums\UserType;
use App\Models\Scopes\UserRoleScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Yajra\DataTables\DataTables;

class Lender extends User
{

    public static function dataTable($query)
    {
        return DataTables::of($query->with('info', 'myRequests')->withCount('rates'))
            ->addColumn('id', function ($model) {
                return $model->id;
            })
            ->addColumn('name', function ($model) {
                return $model->info->name;
            })
            ->addColumn('qty_orders', function ($model) {
                return $model->myRequests->count();
            })
            ->addColumn('rating', function ($model) {
                $rating = $model->rating;
                return "$rating <i class='fas fa-star text-warning'></i>";
            })
            ->addColumn('earned', function ($model) {
                return $model->myRequests()->where('status', OrderStatus::ACCEPTED)->sum('total_price');
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'lenders'
                ])->render();
            })
            ->rawColumns(['rating', 'action'])
            ->make(true);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserRoleScope(UserType::LENDER));
    }

    public function products()
    {
        return $this->hasMany(Product::class)->withoutGlobalScopes();
    }

    protected function roleName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst(UserType::LENDER),
        );
    }


}
