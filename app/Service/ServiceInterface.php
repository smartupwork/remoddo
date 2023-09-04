<?php


namespace App\Service;


use App\DTO\DTOInterface;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{

    public function handle(DTOInterface $dto, ?Model $model = null);
}
