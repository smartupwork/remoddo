<?php


namespace App\Utils\Sorting;


use App\Contract\Sorting\SortingContract;
use App\Models\Product;

class OrderSorting implements SortingContract
{

    public function sorting(?string $sorting = null)
    {
        switch ($sorting) {
            case 'title':
                $sort = Product::select('title')->whereColumn('products.id', 'orders.product_id');
                break;
            case 'price':
                $sort = Product::select('price')->whereColumn('products.id', 'orders.product_id');
                break;
            default:
                $sort = 'id';
                break;
        }
        return $sort;
    }
}
