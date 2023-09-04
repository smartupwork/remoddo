<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'product_views';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
