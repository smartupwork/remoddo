<?php


namespace App\Repository;

use App\Contract\Common\SelectModelContract;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements SelectModelContract
{

    private Model $model;

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): static
    {
        $this->model = $model;
        return $this;
    }

    abstract public function executeQuery();
}
