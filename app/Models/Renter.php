<?php


namespace App\Models;


use App\Enums\OrderStatus;
use App\Enums\UserType;
use App\Models\Scopes\UserRoleScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Yajra\DataTables\DataTables;

class Renter extends User
{

    public static function dataTable($query)
    {
        return DataTables::of($query->with('info', 'rentals')->withCount('rentals'))
            ->addColumn('id', function ($model) {
                return $model->id;
            })
            ->addColumn('name', function ($model) {

                return $model->info->name;
            })
            ->addColumn('qty_orders', function ($model) {
                return $model->rentals_count ?? 0;
            })
            ->addColumn('rating', function ($model) {
                $rating = $model->rating;
                return "$rating <i class='fas fa-star text-warning'></i>";
            })
            ->addColumn('monthly_paid', function ($model) {
                $end = Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
                $start = Carbon::now()->subMonth()->format('Y-m-d');
                return $model->rentals()
                    ->whereBetween('created_at', [$start, $end])
                    ->where('status', OrderStatus::ACCEPTED)
                    ->sum('total_price');
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'renters'
                ])->render();
            })
            ->rawColumns(['rating', 'action'])
            ->make(true);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserRoleScope(UserType::RENTER));
    }

    protected function roleName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst(UserType::RENTER),
        );
    }
}
