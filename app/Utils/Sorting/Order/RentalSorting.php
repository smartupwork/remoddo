<?php


namespace App\Utils\Sorting\Order;


use App\Contract\Sorting\SortingContract;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Rating;

class RentalSorting implements SortingContract
{

    public function sorting(?string $sorting = null)
    {
        switch ($sorting) {
            case 'A-Z':
                $column = "(select name from user_infos where orders.renter_id=user_infos.user_id)";
                $sort = 'asc';
                break;
            case 'Z-A':
                $column = "(select name from user_infos where orders.renter_id=user_infos.user_id)";
                $sort='desc';
                break;
            case 'new-completed':
                $column="FIELD(status , 'new', 'is_coming', 'in_wardrobe','shipped_back','accepted','completed')";
                $sort='asc';
                break;
            case 'completed-new':
                $column="FIELD(status , 'new', 'is_coming', 'in_wardrobe','shipped_back','accepted','completed')";
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
