<?php

namespace App\Service\Admin\Datatable;

interface DatatableInterface
{
    public static function makeEntityList($model, ?int $id = null);
}
