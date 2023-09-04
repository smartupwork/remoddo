<?php


namespace App\Handler;

use App\Contract\Common\SelectModelContract;
use App\Contract\Handler\HandlerContract;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractHandler implements HandlerContract, SelectModelContract
{
    private Model $model;

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;
        return $this;
    }

    abstract public function handle();

}
