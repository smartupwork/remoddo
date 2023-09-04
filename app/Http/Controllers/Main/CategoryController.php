<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryParentSearchResource;
use App\Models\Category;
use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    
    private ProductRepository $productRepository;
    
    public function __construct(ProductRepository $productRepository)
    {
        
        $this->productRepository = $productRepository;
    }


    public function index(Request $request)
    {
        
        $products = $this->productRepository->list();
        $productCount=$this->productRepository->productCount();
        $title = 'All Categories';
        return view('main.pages.category', compact('products', 'title','productCount'));
    }

    public function productsByCategory(Category $category, Request $request)
    {
        
        // dd($category);
        $title = "Category | $category->title";
        $request->merge(['category' => [$category->id]]);
        $products = $this->productRepository->list();
        $productCount=$this->productRepository->productCount();

        return view('main.pages.category', compact('products', 'title','productCount'));
    }

    public function search(Request $request,?Product $product=null)
    {
        
        $search=$request->get('search');
        $categories = Category::with(['children'=>function($query){
            $query->withCount('products');
        }])
            ->where('is_show', true)
            ->when($search,function ($query)use($search){
                $query->whereHas('children',function ($query) use($search){
                        $query->where('title','like',"$search%");
                    });
            })->when(empty($search),function ($query){
                $query->whereNull('parent_id');
            })
            ->get();
        $category_ids=[];
        if ($product){
            $category_ids=$product->categories->pluck('id')->toArray();
        }


        return CategoryParentSearchResource::customCollection($categories,$category_ids);
    }

}
