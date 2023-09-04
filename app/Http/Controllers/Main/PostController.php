<?php

namespace App\Http\Controllers\Main;

use App\DTO\Main\PostDto;
use App\Enums\GenderType;
use App\Handler\Command\Main\Product\SaveHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\PostStoreRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private PostDto $dto;
    private HandlerService $service;

    public function __construct(PostDto $dto, HandlerService $service)
    {
        $this->dto = $dto;
        $this->service = $service;
    }

    public function list()
    {
        $page = Page::get('/post/list');
        $brands = Brand::pluck('title', 'id');
        $tags_count = Tag::where('is_show', true)->count();
        $attributes = Attribute::with('values')->where('is_show', true)->get();
        $product = new Product();
        $product_attributes = [];
        $url = route('main.post.store');
        $prev_url=route('main.profile.lender.overview');
        $categories_id=[];
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

    public function store(PostStoreRequest $request)
    {
        $dto = $this->dto->make($request);
        $handler = $this->service->setHandler(new SaveHandler)->getHandler();
        $handler->setModel(new Product())
            ->setDto($dto)
            ->handle();
        return $this->jsonSuccess('', [
            'url' => route('main.profile.lender.wardrobe.index')
        ]);
    }

    public function deleteImage(ProductImage $image)
    {
        $image_url=$image->getAttributes()['image'];
        $image->delete();

        Storage::disk('products')->delete($image_url);
        return $this->jsonSuccess('');
    }
}
