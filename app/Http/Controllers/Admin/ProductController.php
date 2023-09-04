<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\Product\ProductDTO;
use App\Enums\BrandConfirmationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Repository\Common\Product\DeleteRepository;
use App\Service\Admin\Datatable\ProductDatatable;
use App\Service\Admin\Datatable\ProductRenterDatatable;
use App\Service\Admin\ProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private ProductDTO $dto;
    private ProductService $service;

    public function __construct(ProductDTO $dto, ProductService $service)
    {
        $this->dto = $dto;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $brandConfirmations = BrandConfirmationStatus::getValues();
        $attributes = Attribute::where('show_in_products_table', true)->get();
        if (!$request->ajax()) {
            return view('admin.sections.products.index', compact('brandConfirmations', 'attributes'));
        }
        return ProductDatatable::makeEntityList(Product::customSelected());
    }

    public function edit(Product $product)
    {
        $product_attributes = $product->attributes->pluck('attribute_id', 'attribute_value_id')->toArray();

        $categories = Category::with('children')->get();
        $brands = Brand::pluck('title', 'id');
        $brandConfirmations = BrandConfirmationStatus::getValues();
        $attributes = Attribute::with('values')->where('is_show', true)->get();
        return view('admin.sections.products.edit',
            compact('product',
                'categories',
                'brands',
                'brandConfirmations',
                'attributes',
                'product_attributes'
            )
        );
    }

    public function update(Product $product, ProductRequest $request)
    {

        $dto = $this->dto->make($request);
        $this->service->handle($dto, $product);
        return redirect()->route('admin.products.edit', ['product' => $product->id]);
    }

    public function destroy(Product $product)
    {
        try {
            (new DeleteRepository())->setModel($product)->executeQuery();
            return $this->jsonSuccess('Product deleted successfully');
        } catch (Exception $exception) {
            return $this->jsonError($exception->getMessage());
        }
    }

    public function renterList(Product $product)
    {
        return ProductRenterDatatable::makeEntityList($product->orders());
    }

}
