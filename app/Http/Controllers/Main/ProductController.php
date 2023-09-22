<?php

namespace App\Http\Controllers\Main;

use App\Enums\ProductStatus;
use App\Handler\Command\Main\Product\LikeHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Lender;
use App\Models\Product;
use App\Models\Setting;
use App\Repository\ProductRepository;
use App\Utils\Sorting\ProductSorting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private HandlerService $service;
    private ProductRepository $productRepository;

    public function __construct(HandlerService $service, ProductRepository $productRepository)
    {
        
        $this->service = $service;
        $this->productRepository = $productRepository;
    }


    public function detail(Product $product)
    {
        $product = Product::customSelected()->find($product->id);
        
        $session = request()->session();

        $redirect_url = route('main.category.list');
        $redirect_title = 'All Categories';

        if ($session->has('redirect')) {
            $redirect_url = $session->get('redirect')['url'];
            $redirect_title = $session->get('redirect')['title'];
        }
        if ($session->has('rent_shipping')) {
            $session->forget('rent_shipping');
        }

        $attributes = Attribute::where('is_show', true)->pluck('title', 'id');

        $categories_id = $product->categories->pluck('id')->toArray();
        $random_products = Product::customSelected()->with([ 'categories' => function ($query) use ($categories_id) {
            return $query->whereIn('category_id', $categories_id);
        }])->inRandomOrder()->limit(10)->get();

        $lender_products = Product::customSelected()
            ->where('lender_id', $product->lender_id)
            ->limit(10)->get();

        $attribute_list = [];

        foreach ($attributes as $id => $attribute) {
            $attribute_list[] = [
                'id' => $id,
                'title' => $attribute,
                'values' => $product->values()
                    ->where('attribute_value_product.attribute_id', $id)
                    ->pluck('value')->join(', ')
            ];
        }
        $reviews = DB::table('reviews')
        ->join('user_infos', 'reviews.user_id', '=', 'user_infos.user_id')
        ->select('reviews.*', 'user_infos.name as user_name', 'user_infos.avatar as user_image')
        ->where('reviews.product_id', $product->id)
        ->get();
    // dd($reviews);
    // exit;
        return view('main.pages.product.detail', [
            'reviews' => $reviews,
            'product' => $product,
            'attributes' => $attribute_list,
            'random_products' => $random_products,
            'lender_products' => $lender_products,
            'redirect_url' => $redirect_url,
            'redirect_title' => $redirect_title,
        ]);
    }


    public function like(Product $product)
    {
        $handler = $this->service
            ->setHandler(new LikeHandler)
            ->getHandler();
        $handler->setModel($product)->handle();
        return $this->jsonSuccess('', [
            'image' => $product->like()
                ? asset('main/img/icons/heart.svg')
                : asset('main/img/icons/heart-white.svg')
        ]);
    }


    public function lenderProducts(Lender $lender, Request $request)
    {
        
        $title = "Products of {$lender->info->full_name}";
        $request->merge(['lender' => [$lender->id]]);
        $products = $this->productRepository->list();
        $productCount=$this->productRepository->productCount();

        return view('main.pages.category', compact('products', 'title','productCount'));
    }

    public function newProducts()
    {
        
        // $now = Carbon::now()->format('Y-m-d 00:00:00');
        // where('created_at', '>=', $now);
        $title = 'New In';
        [$column,$sort]=(new ProductSorting())->sorting(request()->get('sort'));
        $query=$this->productRepository->products()->with('values')
            ->latest('created_at');
        $products = $query->orderBy($column,$sort)
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();
            
        $productCount=$query->get()->count();
        return view('main.pages.category', compact('products', 'title','productCount'));
    }

    public function trendProducts()
    {
        $title = 'Trending';
        [$column,$sort]=(new ProductSorting())->sorting(request()->get('sort'));
        $query=$this->productRepository->products()->whereHas('views');
        $products = $query->withCount('views')
            ->with(['likes'])
            ->orderBy($column,$sort)
            ->paginate(config('model_pagination.product.per_page'))
            ->withQueryString();
        $productCount=$query->get()->count();
        return view('main.pages.category', compact('products', 'title','productCount'));
    }

    public function search(Request $request)
    {
        $products = $this->productRepository->products();
        $productCount=$this->productRepository->productCount();
        if ($request->ajax()) {
            
            return $this->jsonSuccess('', [
                'data' => $products->select('title')->limit(10)->pluck('title')
            ]);
        }
        $products = $products->with('values')
            ->orderBy(request()->get('sort') ?? 'id')
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();

        $title = "Search Result | {$request->get('search')}";
        return view('main.pages.category', compact('products', 'title','productCount'));

    }

    public function previousPage(Request $request)
    {
        $session = $request->session();
        if ($session->has('redirect')) {
            $session->forget('redirect');
        }
        $session->put('redirect', [
            'url' => $request->get('redirect_url'),
            'title' => $request->get('redirect_title'),
        ]);
        return $this->jsonSuccess('');
    }
}
