<?php


namespace App\Contract\Common;

use Illuminate\Database\Eloquent\Model;

interface SelectModelContract
{
    public function setModel(Model $model);

    public function getModel(): Model;
}
