<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $table = 'rents';

    protected $guarded = [];

    protected $appends = [
        'day',
        'service_fee',
        'shipping_price',
        'late_fee_price',
        'deposit_price',
        'total_price',
        'total_rent_price',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class, 'renter_id');
    }

    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->rent_day > 1 ? "$this->rent_day days" : "$this->rent_day day",
        );
    }

    protected function totalRentPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->rent_price,
        );
    }

    protected function serviceFee(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->total_rent_price * service_fee() / 100,
        );
    }

    protected function shippingPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->total_rent_price * shipping_fee() / 100,
        );
    }

    protected function lateFeePrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->total_rent_price * late_fee() / 100,
        );
    }

    protected function depositPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->total_rent_price * deposit_fee() / 100,
        );
    }


    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->total_rent_price + $this->service_fee +$this->deposit_price,
        );
    }
}
