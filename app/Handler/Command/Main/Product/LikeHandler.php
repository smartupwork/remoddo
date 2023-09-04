<?php

namespace App\Handler\Command\Main\Product;

use App\Handler\AbstractHandler;
use App\Repository\Main\Product\LikeRepository;

class LikeHandler extends AbstractHandler
{


    public function handle()
    {
        (new LikeRepository())->setModel($this->getModel())->executeQuery();
    }

}
