<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\Category\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Service\Admin\CategoryService;
use App\Service\Admin\Datatable\CategoryDatatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryChildrenController extends Controller
{

    private CategoryDTO $dto;
    private CategoryService $service;

    public function __construct(CategoryDTO $dto, CategoryService $service)
    {
        $this->dto = $dto;
        $this->service = $service;
    }

    public function index(Category $category, Request $request)
    {
        if (!$request->ajax()) {
            $url = route('admin.categories.children.create', ['category' => $category->id]);
            return view('admin.sections.categories.index', compact('url'));
        }
        return CategoryDatatable::makeEntityList(new Category, $category->id);
    }

    public function create(Category $category)
    {
        $title = 'Create child category';
        $url = route('admin.categories.children.store', ['category' => $category->id]);
        $cancel_url = route('admin.categories.children.index', ['category' => $category->id]);
        $category = null;
        return view('admin.sections.categories.save_form', compact('title', 'url', 'category', 'cancel_url'));
    }


    public function store(Category $category, CategoryRequest $request)
    {
        $request->request->add(['parent_id' => $category->id]);
        $dto = $this->dto->make($request);
        $this->service->handle($dto, new Category);
        return $this->jsonSuccess('Child category created successfully', [
            'redirect' => route('admin.categories.children.index', ['category' => $category->id])
        ]);
    }

    public function edit(Category $category, Category $child)
    {
        $title = 'Edit  child category';
        $url = route('admin.categories.children.update', ['category' => $category->id, 'child' => $child->id]);
        $cancel_url = route('admin.categories.children.index', ['category' => $category->id]);
        return view('admin.sections.categories.save_form',
            [
                'category' => $child,
                'title' => $title,
                'url' => $url,
                'cancel_url' => $cancel_url,
            ]
        );
    }

    public function update(Category $category, Category $child, CategoryRequest $request)
    {
        $request->request->add(['parent_id' => $category->id]);
        $dto = $this->dto->make($request);
        $this->service->handle($dto, $child);
        return $this->jsonSuccess('Child category updated successfully', [
            'redirect' => route('admin.categories.children.edit',
                ['category' => $category->id, 'child' => $child->id])
        ]);
    }

    public function destroy(Category $category, Category $child)
    {
        $path = $child->getAttributes()['image'];
        $child->delete();
        Storage::disk($child->getDiskName())->delete($path);
        return $this->jsonSuccess('Category deleted successfully');
    }
}
