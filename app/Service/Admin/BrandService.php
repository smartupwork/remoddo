<?php


namespace App\Service\Admin;

use App\DTO\Admin\Brand\BrandDTO;
use App\DTO\DTOInterface;
use App\Models\Brand;
use App\Repository\BrandRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class BrandService implements ServiceInterface
{


    /**
     * @param BrandDTO
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        $repository = new BrandRepository($model ?? new Brand);
        $repository->save($dto);
    }
}
