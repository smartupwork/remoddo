<?php


namespace App\Repository\Main\Product;

use App\Models\Product;
use App\Models\ProductLike;
use App\Repository\AbstractRepository;

class LikeRepository extends AbstractRepository
{
    public function executeQuery()
    {
        /**
         * @var Product $model
         */
        $model = $this->getModel();

        if ($model->like() && $model->like()->exists()) {
            $model->like()->delete();
        } else {
            $model->likes()->saveMany([
                new ProductLike(['user_id' => auth()->user()->id])
            ]);
        }
    }


}
