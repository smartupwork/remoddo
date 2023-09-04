<?php


namespace App\Repository;

use App\DTO\Admin\Brand\BrandDTO;
use App\DTO\DTOInterface;
use App\Models\Tag;

class TagRepository implements RepositoryInterface
{


    private Tag $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function list()
    {

    }

    public function search()
    {
    }

    public function findBy(array $condition)
    {
        return $this->tag->where($condition)->first();
    }

    /**
     * @param BrandDTO $dto
     */
    public function save(DTOInterface $dto)
    {
        $this->tag->setTitle($dto->getTitle())
            ->setIsShow($dto->getIsShow());
        $this->tag->save();
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
