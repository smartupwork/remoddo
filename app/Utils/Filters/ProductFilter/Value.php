<?php


namespace App\Utils\Filters\ProductFilter;

use App\Utils\Filters\FilterContract;

class Value implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $ids=[];
        foreach (array_values($value) as $id){
            $ids=array_merge($ids,$id);
        }


        $this->query->whereHas('values', function ($query) use ($ids) {
            return $query->whereIn('attribute_value_id', $ids);
        });
    }
}
