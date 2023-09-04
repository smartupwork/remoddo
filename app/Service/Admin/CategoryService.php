<?php


namespace App\Service\Admin;

use App\DTO\Admin\Category\CategoryDTO;
use App\DTO\DTOInterface;
use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryService implements ServiceInterface
{

    /**
     * @param CategoryDTO
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        $repository = new CategoryRepository($model ?? new Category);
        $repository->save($dto);
    }
}
