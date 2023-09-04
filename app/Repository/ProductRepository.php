<?php


namespace App\Repository;

use App\DTO\Admin\Product\ProductDTO;
use App\DTO\DTOInterface;
use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Utils\Sorting\ProductSorting;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductRepository implements RepositoryInterface
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
      
    }


    public function list()
    {
        
        [$column,$sort]=(new ProductSorting())->sorting(request()->get('sort'));
        return $this->products()
            ->orderBy($column,$sort)
            ->paginate(config('model_pagination.product.per_page'))->withQueryString();
    }

    public function productCount()
    {
        return $this->products()->get()->count();
    }

    public function findBy(array $condition)
    {
        return $this->product->where($condition)->first();
    }

    /**
     * @param ProductDTO $dto
     */
    public function save(DTOInterface $dto)
    {

        try {
            DB::beginTransaction();
            $images = [];
            $product_attributes = [];


            foreach ($dto->getAttributes() as $attribute_id => $attribute_params) {
                $product_attributes[] = $this->createAttr($this->product->id, $attribute_id, array_values($attribute_params));
            }

            $product_attributes = array_reduce($product_attributes, 'array_merge', []);

            if (!empty($dto->getImages())) {
                foreach ($dto->getImages() as $image) {
                    $images[] = new ProductImage([
                        'image' => Storage::disk($this->product->getDiskName())->put('', $image)
                    ]);
                }
                $this->product->images()->saveMany($images);
            }

            $this->product->setTitle($dto->getTitle())
                ->setPeriodDay($dto->getPeriodDay())
                ->setPrice($dto->getPrice())
                ->setAddress($dto->getAddress())
                ->setBrandConfirmation($dto->getBrandConfirmation())
                ->setBrandId($dto->getBrandId())
                ->setDescription($dto->getDescription())
                ->save();

            $this->product->attributes()->delete();

            ProductAttribute::insert($product_attributes);

            $this->product->categories()->detach();

            $this->product->categories()->attach($dto->getCategoryId());

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
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
                return $this->createAttr($productId, $attrId, $param);
            }
        }
        return $result;
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function search()
    {
        // TODO: Implement search() method.
    }

    public function products(){
    
      return  $this->product::customSelected()->with('values')
            ->filterBy(request()->all())
            ->where('status', ProductStatus::ACTIVE)
          ;
    }
}
