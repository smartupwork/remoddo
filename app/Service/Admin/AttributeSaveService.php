<?php

namespace App\Service\Admin;

use App\DTO\Admin\Attribute\AttributeDTO;
use App\DTO\DTOInterface;
use App\Models\Attribute;
use App\Repository\AttributeRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class AttributeSaveService implements ServiceInterface
{

    /**
     * @param AttributeDTO $dto
     * @param Attribute|null $model
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        $repository = new AttributeRepository($model ?? new Attribute());
        $repository->save($dto);
    }
}
