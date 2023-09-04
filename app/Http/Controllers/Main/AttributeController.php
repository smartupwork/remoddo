<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Repository\AttributeRepository;

class AttributeController extends Controller
{
    public function search(Attribute $attribute)
    {
        $repository = new AttributeRepository($attribute);
        $attributeValues = $repository->search();
        return $this->jsonSuccess('', [
            'data' => $attributeValues
        ]);
    }
}
