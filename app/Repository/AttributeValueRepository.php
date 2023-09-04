<?php


namespace App\Repository;

use App\DTO\Admin\Attribute\AttributeValueDTO;
use App\DTO\DTOInterface;
use App\Models\AttributeValue;

class AttributeValueRepository implements RepositoryInterface
{


    private AttributeValue $attributeValue;

    public function __construct(AttributeValue $attributeValue)
    {
        $this->attributeValue = $attributeValue;
    }


    public function list()
    {
        // TODO: Implement list() method.
    }

    public function findBy(array $condition)
    {
        return $this->attributeValue->where($condition)->first();
    }

    /**
     * @param AttributeValueDTO $dto
     */
    public function save(DTOInterface $dto)
    {
        $this->attributeValue->setAttributeId($dto->getAttributeId())
            ->setValue($dto->getValue())
            ->save();
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function search()
    {
        // TODO: Implement search() method.
    }
}
