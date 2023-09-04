<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Repository\BrandRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    private BrandRepository $brandRepository;
    private ProductRepository $productRepository;

    public function __construct(BrandRepository $brandRepository, ProductRepository $productRepository)
    {
        
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
       
        $brands = Brand::select('id', 'title')->where('is_show', true)->orderBy('title')->get();

        $lastChar = '';

        $brand_list = [];
        $key = '';
        foreach ($brands as $brand) {
            $char = $brand->title[0];
            if ($char !== $lastChar) {
                $key = strtoupper($char);
                if ((int)$char > 0) {
                    $key = '0-9';
                }
                $lastChar = $char;
            }
            $brand_list[$key][] = $brand;
        }
        $filter_list = array_keys($brand_list);
        return view('main.pages.brand.index', compact('brand_list', 'filter_list'));
    }

    public function productsByBrand(Brand $brand, Request $request)
    {
        $title = "Brand | $brand->title";
        $request->merge(['brand' => [$brand->id]]);
        $products = $this->productRepository->list();
        $productCount=$this->productRepository->productCount();

        return view('main.pages.category', compact('products', 'title','productCount'));
    }

    public function search()
    {
        $brands = $this->brandRepository->search();
        return $this->jsonSuccess('', [
            'data' => $brands
        ]);
    }
}
