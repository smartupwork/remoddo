<?php


namespace App\Service\Admin;

use App\DTO\Admin\Product\ProductDTO;
use App\DTO\DTOInterface;
use App\Models\Product;
use App\Repository\ProductRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class ProductService implements ServiceInterface
{

    /**
     * @param ProductDTO
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        $repository = new ProductRepository($model ?? new Product);
        $repository->save($dto);
    }
}
