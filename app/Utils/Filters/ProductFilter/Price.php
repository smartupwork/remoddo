<?php


namespace App\Utils\Filters\ProductFilter;

use App\Utils\Filters\FilterContract;

class Price implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $min = $value['min'] ?? null;
        $max = $value['max'] ?? null;

        if ($min > $max) {
            $temp = $max;
            $max = $min;
            $min = $temp;
        }

        $this->query->when($min, function ($query) use ($min) {
            return $query->where('price', '>', $min);
        })->when($max, function ($query) use ($max) {
            return $query->where('price', '<', $max);
        });
    }
}
