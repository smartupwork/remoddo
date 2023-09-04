<?php


namespace App\Repository;

use App\DTO\Admin\Attribute\AttributeDTO;
use App\DTO\DTOInterface;
use App\Models\Attribute;

class AttributeRepository implements RepositoryInterface
{


    private Attribute $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }


    public function list()
    {
        // TODO: Implement list() method.
    }

    public function findBy(array $condition)
    {
        return $this->attribute->where($condition)->first();
    }

    /**
     * @param AttributeDTO $dto
     */
    public function save(DTOInterface $dto)
    {
        $this->attribute->setName($dto->getName())
            ->setTitle($dto->getTitle())
            ->setIsRequired($dto->getIsRequired())
            ->setIsShow($dto->getIsShow())
            ->setIsMultiple($dto->getIsMultiple())
            ->setShowInProductsTable($dto->getShowInProductsTable())
            ->save();
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function search()
    {
        $search = request()->get('search');

        return $this->attribute->values()->with('products:id')
            ->select('id', 'value')
            ->when($search, function ($query) use ($search) {
                $query->where('value', 'like', "%$search%");
            })
            ->get();
    }
}
