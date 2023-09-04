<?php


namespace App\View\Composers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\View\View;

class ProductFilterComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $product_counts = [
            'products' => function ($query) {
                return $query->filterBy(request()->all());
            }
        ];


        $categories = Category::withCount($product_counts)
            ->where('is_show', true)->get();
        $brands = Brand::withCount($product_counts)->where('is_show', true)->get();
        $attributes = Attribute::with(['values' => function ($query) use ($product_counts) {
            return $query->withCount($product_counts);
        }])
            ->where('is_show', true)->get();

        $view->with('categories', $categories)
            ->with('brands', $brands)
            ->with('attributes', $attributes);
    }
}
