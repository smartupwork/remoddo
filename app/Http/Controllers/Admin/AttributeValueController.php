<?php

namespace App\Http\Controllers\Admin;


use App\DTO\Admin\Attribute\AttributeValueDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Service\Admin\AttributeValueSaveService;
use App\Service\Admin\Datatable\AttributeValueDatatable;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{


    private AttributeValueDTO $attributeValueDTO;
    private AttributeValueSaveService $saveService;

    public function __construct(AttributeValueDTO $attributeValueDTO, AttributeValueSaveService $saveService)
    {
        $this->attributeValueDTO = $attributeValueDTO;
        $this->saveService = $saveService;
    }

    public function index(Attribute $attribute, Request $request)
    {

        if (!$request->ajax()) {
            return view('admin.sections.attributes.values.index', compact('attribute'));
        }

        return AttributeValueDatatable::makeEntityList($attribute->values);
    }

    public function create(Attribute $attribute)
    {
        $title = 'Create attribute value';
        $url = route('admin.attributes.values.store', ['attribute' => $attribute->id]);
        $data = null;
        return view('admin.sections.attributes.values.save_form', compact('title', 'url', 'data', 'attribute'));
    }


    public function store(Attribute $attribute, AttributeValueRequest $request)
    {
        $request->request->add(['attribute_id' => $attribute->id]);
        $dto = $this->attributeValueDTO->make($request);
        $this->saveService->handle($dto, new AttributeValue);
        return $this->jsonSuccess('Attribute created successfully', [
            'redirect' => route('admin.attributes.values.index', ['attribute' => $attribute->id])
        ]);
    }

    public function edit(Attribute $attribute, AttributeValue $value)
    {
        $title = 'Edit attribute value';
        $url = route('admin.attributes.values.update', ['attribute' => $attribute->id, 'value' => $value->id]);
        $data = $value;
        return view('admin.sections.attributes.values.save_form', compact('title', 'url', 'data', 'attribute'));
    }

    public function update(Attribute $attribute, AttributeValue $value, AttributeValueRequest $request)
    {
        $request->request->add(['attribute_id' => $attribute->id]);
        $dto = $this->attributeValueDTO->make($request);
        $this->saveService->handle($dto, $value);
        return $this->jsonSuccess('Attribute value created successfully', [
            'redirect' => route('admin.attributes.values.edit', ['attribute' => $attribute->id, 'value' => $value->id])
        ]);
    }

    public function destroy(Attribute $attribute, AttributeValue $value)
    {
        $value->delete();

        return $this->jsonSuccess('Attribute value deleted successfully');
    }
}
