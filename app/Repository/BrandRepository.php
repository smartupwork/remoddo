<?php


namespace App\Repository;

use App\DTO\Admin\Brand\BrandDTO;
use App\DTO\DTOInterface;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandRepository implements RepositoryInterface
{

    private Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function list()
    {

    }

    public function search()
    {
        return $this->brand
            ->select('id', 'title')
            ->withCount('products')
            ->when(request()->get('search'), function ($query) {
                return $query->filterBy(request()->all());
            })
            ->get();
    }

    public function findBy(array $condition)
    {
        return $this->brand->where($condition)->first();
    }

    /**
     * @param BrandDTO $dto
     */
    public function save(DTOInterface $dto)
    {
        $this->brand->setTitle($dto->getTitle())
            ->setIsShow($dto->getIsShow());

        if ($dto->getImage()) {
            //TODO CREATE IMAGE UTILS
            $attributes = $this->brand->getAttributes();

            if (isset($attributes['image'])) {
                $path = $attributes['image'];
                Storage::disk($this->brand->getDiskName())->delete($path);
            }
            $this->brand->setImage(Storage::disk($this->brand->getDiskName())->put('', $dto->getImage()));
        }
        $this->brand->save();
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
