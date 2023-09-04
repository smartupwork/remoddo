<?php

namespace App\Service\Admin;

use App\DTO\Admin\Attribute\AttributeValueDTO;
use App\DTO\DTOInterface;
use App\Models\AttributeValue;
use App\Repository\AttributeValueRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class AttributeValueSaveService implements ServiceInterface
{

    /**
     * @param AttributeValueDTO $dto
     * @param AttributeValue|null $model
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        $repository = new AttributeValueRepository($model);
        $repository->save($dto);
    }
}
