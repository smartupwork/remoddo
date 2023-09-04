<?php


namespace App\Utils\Sorting\Order;


use App\Contract\Sorting\SortingContract;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Rating;

class WardrobeSorting implements SortingContract
{

    public function sorting(?string $sorting = null)
    {
        switch ($sorting) {
            case 'oldest':
                $column = 'id';
                $sort = 'asc';
                break;
            case 'A-Z':
                $column='title';
                $sort='asc';
                break;
            case 'Z-A':
                $column='title';
                $sort='desc';
                break;
            case 'active-hide':
                $column="FIELD(status , 'active', 'hide')";
                $sort='asc';
                break;
            case 'hide-active':
                $column="FIELD(status , 'active', 'hide')";
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
