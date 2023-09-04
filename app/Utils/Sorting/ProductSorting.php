<?php


namespace App\Utils\Sorting;


use App\Contract\Sorting\SortingContract;
use App\Models\Brand;
use App\Models\Product;

class ProductSorting implements SortingContract
{

    public function sorting(?string $sorting = null)
    {
        switch ($sorting) {
            case 'title':
                $column = 'title';
                $sort='desc';
                break;
            case 'low-high':
                $column = 'price';
                $sort = 'asc';
                break;
            case 'high-low':
                $column='price';
                $sort='desc';
                break;
            case 'A-Z':
                $column=Brand::select('title')->whereColumn('brands.id', 'products.brand_id');
                $sort='asc';
                break;
            case 'Z-A':
                $column=Brand::select('title')->whereColumn('brands.id', 'products.brand_id');
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
