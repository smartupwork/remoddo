<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\Attribute\AttributeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;
use App\Models\Attribute;
use App\Service\Admin\AttributeSaveService;
use App\Service\Admin\Datatable\AttributeDatatable;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    private AttributeDTO $attributeDTO;
    private AttributeSaveService $saveService;

    public function __construct(AttributeDTO $attributeDTO, AttributeSaveService $saveService)
    {
        $this->attributeDTO = $attributeDTO;
        $this->saveService = $saveService;
    }


    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.attributes.index');
        }

        return AttributeDatatable::makeEntityList((new Attribute)->query());
    }

    public function create()
    {
        $title = 'Create attribute';
        $url = route('admin.attributes.store');
        $attribute = null;
        return view('admin.sections.attributes.save_form', compact('title', 'url', 'attribute'));
    }

    public function store(AttributeRequest $request)
    {
        $dto = $this->attributeDTO->make($request);
        $this->saveService->handle($dto, new Attribute);
        return $this->jsonSuccess('Attribute created successfully', [
            'redirect' => route('admin.attributes.index')
        ]);
    }

    public function edit(Attribute $attribute)
    {

        $title = 'Edit attribute';
        $url = route('admin.attributes.update', ['attribute' => $attribute->id]);
        return view('admin.sections.attributes.save_form', compact('attribute', 'title', 'url'));
    }

    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $dto = $this->attributeDTO->make($request);
        $this->saveService->handle($dto, $attribute);
        return $this->jsonSuccess('Attribute updated successfully', [
            'redirect' => route('admin.attributes.edit', ['attribute' => $attribute->id])
        ]);
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return $this->jsonSuccess('Attribute deleted successfully');
    }
}
