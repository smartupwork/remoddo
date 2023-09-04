<?php


namespace App\Repository\Common\Product;


use App\Repository\AbstractRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteRepository extends AbstractRepository
{

    public function executeQuery()
    {
        $product = $this->getModel();
        try {
            DB::beginTransaction();
            $images = $product->images;
            $image_arr = [];
            $disk = $product->getDiskName();

            foreach ($images as $image) {
                $image_arr[] = $image->getAttributes()['image'];
            }

            $product->delete();

            Storage::disk($disk)->delete($image_arr);

            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }
}
