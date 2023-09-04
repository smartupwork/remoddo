<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'payment_methods';

    protected $casts = [
        'default_method' => 'bool'
    ];

    protected $appends = ['image', 'title'];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => array_key_exists($this->brand, config('cashier.payment_methods'))
            ? config("cashier.payment_methods.{$this->brand}")
            : config("cashier.payment_methods.visa")
        );
    }

    protected function title(): Attribute
    {
        $brand = ucfirst($this->brand);
        return Attribute::make(
            get: fn($value) => "$brand | $this->card_number"
        );
    }
}
