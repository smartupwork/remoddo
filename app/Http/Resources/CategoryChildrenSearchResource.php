<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryChildrenSearchResource extends JsonResource
{
    private static ?array $category_ids=[];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'parent_id'=>$this->parent_id,
            'title'=>$this->title,
            'product_count'=>$this->products_count,
            'is_checked'=> self::$category_ids && in_array($this->id, self::$category_ids)
        ];
    }

    public static function customCollection($resource, ?array $category_ids=[]): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        //you can add as many params as you want.
        self::$category_ids = $category_ids;
        return parent::collection($resource);
    }
}
