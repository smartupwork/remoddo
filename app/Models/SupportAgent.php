<?php


namespace App\Models;


use App\Enums\OrderStatus;
use App\Enums\UserType;
use App\Models\Scopes\UserRoleScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Yajra\DataTables\DataTables;

class SupportAgent extends User
{

    public static function dataTable($query)
    {
        return DataTables::of($query->with('info'))
            ->addColumn('id', function ($model) {
                return $model->id;
            })
            ->addColumn('name', function ($model) {
                return $model->info->name;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'supports'
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserRoleScope(UserType::SUPPORTAGENT));
    }

    public function statusJob()
    {
        return $this->hasOne(SupportAgentInfo::class)->withoutGlobalScopes();
    }

    protected function roleName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst(UserType::SUPPORTAGENT),
        );
    }


}
