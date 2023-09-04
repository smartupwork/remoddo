<?php


namespace App\Utils\Sorting\Order;


use App\Contract\Sorting\SortingContract;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Rating;

class RequestSorting implements SortingContract
{

    public function sorting(?string $sorting = null)
    {
        switch ($sorting) {
            case 'oldest':
                $column = 'id';
                $sort = 'asc';
                break;
            case 'by-rating':
                $column=Rating::select('rate_value')->whereColumn('ratings.order_id', 'orders.id');
                $sort='desc';
                break;
            default:
                $column = 'id';
                $sort='desc';
                break;
        }
        return [$column,$sort];
    }
}
