<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryParentSearchResource extends JsonResource
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
            'title'=>$this->title,
            'image'=>asset('main/img/icons/arrow-right.svg'),
            'children'=>CategoryChildrenSearchResource::customCollection($this->children,self::$category_ids)
        ];
    }

    public static function customCollection($resource, ?array $category_ids=[]): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        //you can add as many params as you want.
        self::$category_ids = $category_ids;
        return parent::collection($resource);
    }
}
