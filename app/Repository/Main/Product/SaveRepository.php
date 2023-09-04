<?php


namespace App\Repository\Main\Product;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\DTO\Main\PostDto;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Rent;
use App\Models\Tag;
use App\Repository\AbstractRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SaveRepository extends AbstractRepository implements SelectDTOContract
{

    private DTOInterface $dto;

    public function executeQuery()
    {
        try {
            DB::beginTransaction();


            $images = [];
            $rents = [];
            $product_attributes = [];
            /**
             * @var Product $model
             */
            $model = $this->getModel();
            /**
             * @var $dto PostDto
             */
            $dto = $this->getDTO();


            $min_rent_day = min(array_keys($dto->getRents()));
            $brandModel = Brand::where('title', $dto->getBrandId())
                ->orWhere('id', $dto->getBrandId())->first();
            if (!$brandModel) {
                $brandModel = Brand::create([
                    'title' => $dto->getBrandId(),
                    'image'=>asset('main/img/images/no_img_avaliable.jpg'),
                    'is_show' => true
                ]);
            }


            $model->setTitle($dto->getTitle())
                ->setGender($dto->getGender())
                ->setDescription($dto->getDescription())
                ->setAddress($dto->getAddress())
                ->setBrandId($brandModel->id)
                ->setLenderId(auth()->user()->id)
                ->setPeriodDay($min_rent_day)
                ->setPrice($dto->getRents()[$min_rent_day])
                ->save();

            $model->attributes()->delete();

            foreach ($dto->getAttributes() as $attribute_id => $attribute_params) {
                $product_attributes[] = $this->createAttr($model->id, $attribute_id, array_values($attribute_params));
            }

            $product_attributes = array_reduce($product_attributes, 'array_merge', []);


            ProductAttribute::insert($product_attributes);

            if ($model->images->count() > 0) {
                ProductImage::whereIn('id', $model->images->pluck('id')->toArray())->update([
                    'is_main' => false
                ]);
            }


            if (!empty($dto->getImages())) {
                foreach ($dto->getImages() as $key => $image) {
                    $images[] = new ProductImage([
                        'image' => Storage::disk($model->getDiskName())->put('', $image),
                        'is_main' => false,
                    ]);
                }
                $model->images()->saveMany($images);
            }

            ProductImage::where('product_id', $model->id)->update([
                'sort'=>0
            ]);

            $product_images = ProductImage::where('product_id', $model->id)->get();

            if ($product_images->count() > 0) {
                foreach ($product_images as $key=>$image) {
                    $image->update([
                        'sort'=>$key
                    ]);
                }
                $new_product_images = ProductImage::where('product_id', $model->id)->get();
                foreach ($new_product_images as $image) {
                    if (isset($dto->getIsMain()[$image->sort])) {
                        if ($dto->getIsMain()[$image->sort] == 'is_main') {
                            $image->update([
                                'is_main' => true
                            ]);
                        }
                    }

                }
            }

            $model->categories()->detach($model->categories()->pluck('category_id')->toArray());
            $model->categories()->attach($dto->getCategoryId());

            if ($dto->getTags()) {

                $tags = [];
                foreach ($dto->getTags() as $tag) {
                    $tagModel = Tag::where('title', $tag)->first();
                    if (!$tagModel) {
                        $tagModel = Tag::create([
                            'title' => $tag,
                            'is_show' => true
                        ]);
                    }
                    $tags[] = $tagModel->id;
                }
                $model->tags()->detach($tags);
                $model->tags()->attach($tags);
            }

            if (!empty($dto->getRents())) {
                $model->rents()->delete();
                foreach ($dto->getRents() as $rent_day => $rent_price) {
                    $rents[] = new Rent([
                        'rent_day' => $rent_day,
                        'rent_price' => $rent_price,
                    ]);
                }
                $model->rents()->saveMany($rents);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function getDTO(): DTOInterface
    {
        return $this->dto;
    }

    public function setDTO(DTOInterface $dto)
    {
        $this->dto = $dto;
        return $this;
    }

    private function createAttr($productId, $attrId, $attrParams)
    {
        $result = [];

        foreach ($attrParams as $param) {
            $result[] = [
                'product_id' => $productId,
                'attribute_id' => (int)$attrId,
                'attribute_value_id' => (int)$param,
            ];
            if (is_array($param)) {
                return $this->createAttr($productId, $attrId, explode(',', $param[0]));
            }
        }
        return $result;
    }


}
