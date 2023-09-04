<?php


namespace App\Repository;

use App\DTO\Admin\Category\CategoryDTO;
use App\DTO\DTOInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements RepositoryInterface
{


    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function list()
    {
        // TODO: Implement list() method.
    }

    public function findBy(array $condition)
    {
        return $this->category->where($condition)->first();
    }

    /**
     * @param CategoryDTO $dto
     */
    public function save(DTOInterface $dto)
    {
        $this->category->setTitle($dto->getTitle())
            ->setIsShow($dto->getIsShow())
            ->setIsPopular($dto->getIsPopular());
        //TODO CREATE IMAGE UTILS
        if ($dto->getImage()) {
            $attributes = $this->category->getAttributes();

            if (isset($attributes['image'])) {
                $path = $attributes['image'];
                Storage::disk($this->category->getDiskName())->delete($path);
            }
            $this->category->setImage(Storage::disk($this->category->getDiskName())->put('', $dto->getImage()));
        }
        if ($dto->getParentId()) {
            $this->category->setParentId($dto->getParentId());
        }

        $this->category->save();
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
