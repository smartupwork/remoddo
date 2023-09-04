<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        

        $page = Page::get('/');

        $popular_categories = Category::where('is_show', true)
            ->where('is_popular', true)->limit(10)->get();
        
        $trending_products = Product::customSelected()->whereHas('views')
            ->withCount('views')
            ->limit(10)
            ->get()->sortByDesc(function ($model) {
                return $model->views_count;
            });
           
        $random_products = Product::customSelected()
            ->limit(10)
            ->inRandomOrder()
            ->get();

            
        return view('main.pages.home', compact(
            'page',
            'popular_categories',
            'trending_products',
            'random_products'
        ));
    }
}
