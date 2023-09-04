<?php

namespace App\Http\Controllers\Main\Profile;

use App\DTO\Main\PostDto;
use App\Enums\GenderType;
use App\Enums\ProductStatus;
use App\Handler\Command\Main\Product\SaveHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\PostRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
use App\Repository\Common\Product\DeleteRepository;
use App\Utils\Sorting\Order\WardrobeSorting;
use Exception;
use Illuminate\Http\Request;


class WardrobeController extends Controller
{

    private PostDto $dto;
    private HandlerService $service;

    public function __construct(PostDto $dto, HandlerService $service)
    {
        $this->dto = $dto;
        $this->service = $service;
    }


    public function index(Request $request)
    {
        [$column, $sort] = (new WardrobeSorting())->sorting($request->get('sort'));
        $products = auth()->user()
            ->products()
            ->orderByRaw("$column $sort")
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();
        return view('main.pages.profile.lender.wardrobe', compact('products'));
    }

    public function edit(Product $product)
    {
        $page = Page::get('/post/list');
        $brands = Brand::pluck('title', 'id');
        $tags_count = Tag::where('is_show', true)->count();
        $attributes = Attribute::with('values')->where('is_show', true)->get();
        $product_attributes = $product->attributes->pluck('attribute_id', 'attribute_value_id')->toArray();
        $url = route('main.profile.lender.wardrobe.update', $product);
        $prev_url = route('main.profile.lender.wardrobe.index');
        $categories_id = $product->categories->pluck('id')->toArray();
        $genders=GenderType::asSelectArray();
        return view('main.pages.post.list', compact(
            'tags_count',
            'brands',
            'attributes',
            'product',
            'product_attributes',
            'url',
            'prev_url',
            'categories_id','genders','page'
        ));
    }

    public function update(Product $product, PostRequest $request)
    {
        $dto = $this->dto->make($request);
        $handler = $this->service->setHandler(new SaveHandler)->getHandler();
        $handler->setModel($product)
            ->setDto($dto)
            ->handle();
        return $this->jsonSuccess('', [
            'url' => route('main.profile.lender.wardrobe.index')
        ]);
    }

    public function updateStatus(Product $product)
    {
        $newStatus = $product->status == ProductStatus::ACTIVE
            ? ProductStatus::HIDE
            : ProductStatus::ACTIVE;
        $product->status = $newStatus;
        $product->save();
        return redirect()->route('main.profile.lender.wardrobe.index');
    }

    public function destroy(Product $product)
    {
        try {
            (new DeleteRepository())->setModel($product)->executeQuery();
            return $this->jsonSuccess('product deleted');
        } catch (Exception $exception) {
            info($exception->getMessage());
            return $this->jsonError('Something is wrong!!!');
        }
    }

    public function isNotAvailableProduct(Product $product)
    {
        try {
            $product->is_not_available = !$product->is_not_available;
            $product->save();
            return redirect()->route('main.profile.lender.wardrobe.index');
        } catch (\Exception $exception) {
            info($exception->getMessage());
            return $this->jsonError('Something is wrong!!!');
        }
    }
}
