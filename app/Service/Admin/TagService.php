<?php


namespace App\Service\Admin;

use App\DTO\Admin\Tag\TagDTO;
use App\DTO\DTOInterface;
use App\Models\Tag;
use App\Repository\TagRepository;
use App\Service\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class TagService implements ServiceInterface
{


    /**
     * @param TagDTO
     */
    public function handle(DTOInterface $dto, ?Model $model = null)
    {
        $repository = new TagRepository($model ?? new Tag());
        $repository->save($dto);
    }
}
