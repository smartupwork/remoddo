<?php


namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryPopuPComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $categories = Category::with('children')
            ->whereHas('children')
            ->whereNull('parent_id')
            ->where('is_show', true)
            ->get();

        $view->with('categories', $categories);
    }
}
