<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\Brand\BrandDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use App\Service\Admin\BrandService;
use App\Service\Admin\Datatable\BrandDatatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    private BrandDTO $dto;
    private BrandService $service;

    public function __construct(BrandDTO $dto, BrandService $service)
    {
        $this->dto = $dto;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.brands.index');
        }
        return BrandDatatable::makeEntityList(new Brand());
    }

    public function create()
    {
        $title = 'Create brand';
        $url = route('admin.brands.store');
        $brand = null;
        return view('admin.sections.brands.save_form', compact('title', 'url', 'brand'));
    }


    public function store(BrandRequest $request)
    {
        $dto = $this->dto->make($request);
        $this->service->handle($dto, new Brand);
        return $this->jsonSuccess('Brand created successfully', [
            'redirect' => route('admin.brands.index')
        ]);
    }

    public function edit(Brand $brand)
    {
        $title = 'Edit brand';
        $url = route('admin.brands.update', ['brand' => $brand->id]);
        return view('admin.sections.brands.save_form', compact('brand', 'title', 'url'));
    }

    public function update(Brand $brand, BrandRequest $request)
    {
        $dto = $this->dto->make($request);
        $this->service->handle($dto, $brand);
        return $this->jsonSuccess('brand created successfully', [
            'redirect' => route('admin.brands.edit', ['brand' => $brand->id])
        ]);
    }

    public function destroy(Brand $brand)
    {
        $path = $brand->getAttributes()['image'];
        $brand->delete();
        Storage::disk($brand->getDiskName())->delete($path);
        return $this->jsonSuccess('Brand deleted successfully');
    }
}
