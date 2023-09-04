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

class CategoryController extends Controller
{

    private CategoryDTO $dto;
    private CategoryService $service;

    public function __construct(CategoryDTO $dto, CategoryService $service)
    {
        $this->dto = $dto;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.categories.index');
        }
        return CategoryDatatable::makeEntityList(new Category);
    }

    public function create()
    {
        $title = 'Create category';
        $url = route('admin.categories.store');
        $category = null;
        $cancel_url = route('admin.categories.index');
        return view('admin.sections.categories.save_form', compact('title', 'url', 'category', 'cancel_url'));
    }


    public function store(CategoryRequest $request)
    {
        $dto = $this->dto->make($request);
        $this->service->handle($dto, new Category);
        return $this->jsonSuccess('Category created successfully', [
            'redirect' => route('admin.categories.index')
        ]);
    }

    public function edit(Category $category)
    {
        $title = 'Edit category';
        $url = route('admin.categories.update', ['category' => $category->id]);
        $cancel_url = route('admin.categories.index');
        return view('admin.sections.categories.save_form', compact('category', 'title', 'url', 'cancel_url'));
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $dto = $this->dto->make($request);
        $this->service->handle($dto, $category);
        return $this->jsonSuccess('Category created successfully', [
            'redirect' => route('admin.categories.edit', ['category' => $category->id])
        ]);
    }

    public function destroy(Category $category)
    {
        $path = $category->getAttributes()['image'];
        $category->delete();
        Storage::disk($category->getDiskName())->delete($path);
        return $this->jsonSuccess('Category deleted successfully');
    }
}
