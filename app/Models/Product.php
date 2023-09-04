<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Models\Scopes\IsActiveScope;
use App\Models\Scopes\ReadyToSellScope;
use App\Utils\Filters\FilterBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Product
 * @package App\Models
 * @property string title
 * @property string gender
 * @property string brand_confirmation
 * @property int period_day
 * @property float price
 * @property int brand_id
 * @property int lender_id
 * @property string address
 * @property string description
 *
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $appends = ['image','brand_title'];

    protected $casts=[
        'is_not_available'=>'bool'
    ];

    public static function customSelected()
    {
        
        $is_liked=0;
        $is_rented=0;
        if (auth()->check()){
           
            $is_liked="exists(select pl.product_id from product_likes as pl where pl.product_id=products.id and pl.user_id=".auth()->user()->id." )";
        }
        // echo ('*,'.$is_liked.' as is_liked,
        // exists(select o.product_id from orders o where (o.product_id=products.id AND
        //       o.exp_date>=now()) or products.is_not_available=1) as is_rented,
        // (select image from product_images pi where pi.product_id=products.id and pi.is_main=1 order by pi.id desc limit 1) as image,
        // (select title from brands where brands.id=products.brand_id) as brand_title
        //       ');
        //       exit;
        return self::selectRaw('*,'.$is_liked.' as is_liked,
       exists(select o.product_id from orders o where (o.product_id=products.id AND
             o.exp_date>=now()) or products.is_not_available=1) as is_rented,
       (select image from product_images pi where pi.product_id=products.id and pi.is_main=1 order by pi.id desc limit 1) as image,
       (select title from brands where brands.id=products.brand_id) as brand_title
             ');

             
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ReadyToSellScope);
        static::addGlobalScope(new IsActiveScope);
        static::saving(function ($question) {
            $question->slug = Str::slug($question->title);
        });
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return self
     */
    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }



    /**
     * @return string
     */
    public function getBrandConfirmation(): string
    {
        return $this->brand_confirmation;
    }

    /**
     * @param string $brand_confirmation
     * @return self
     */
    public function setBrandConfirmation(string $brand_confirmation): self
    {
        $this->brand_confirmation = $brand_confirmation;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeriodDay(): int
    {
        return $this->period_day;
    }

    /**
     * @param int $period_day
     * @return self
     */
    public function setPeriodDay(int $period_day): self
    {
        $this->period_day = $period_day;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brand_id;
    }

    /**
     * @param int $brand_id
     * @return self
     */
    public function setBrandId(int $brand_id): self
    {
        $this->brand_id = $brand_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getLenderId(): int
    {
        return $this->lender_id;
    }

    /**
     * @param int $lender_id
     * @return self
     */
    public function setLenderId(int $lender_id): self
    {
        $this->lender_id = $lender_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return self
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDiskName()
    {
        return 'products';
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderByDesc('is_main');
    }

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function values()
    {
        return $this->belongsToMany(AttributeValue::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->where('is_show', true);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function lender()
    {
        return $this->belongsTo(Lender::class, 'lender_id');
    }

    public function views()
    {
        return $this->hasMany(ProductView::class);
    }

    public function like()
    {
        return $this->likes()->where('user_id', auth()->user()->id)->first();
    }

    public function likes()
    {
        return $this->hasMany(ProductLike::class);
    }

    public function isBuyedProduct()
    {
        $lastOrder = $this->lastOrder();
        if (!$lastOrder) {
            return false;
        }
        $end = $lastOrder->exp_date;
        return Carbon::now()->lessThan($end);
    }

    public function lastOrder()
    {
        return $this->orders()->with('rent')->whereNotIn('status',
            [OrderStatus::FAILED, OrderStatus::DECLINED]
        )->orderByDesc('id')->first();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utils\Filters\ProductFilter';
        $filter = new FilterBuilder($query, $filters, $namespace);
        return $filter->apply();
    }

    protected function image(): Attribute
    {
        return Attribute::make(

        	get: function($value){

        		$image= ($this->images()->orderBy('is_main', 'desc')->first());
        		if($this->id==47){
        		}
        		return ($image && $image->image)?$image->image:asset('main/img/images/no_img_avaliable.jpg');

//				return $value ? Storage::disk('products')->url($value)
//					: ($this->images()->where('is_main',true)->first()
//						? $this->images()->where('is_main',true)->first()->image
//						:  asset('main/img/images/no_img_avaliable.jpg'));

        	}

//            get: fn($value) => $value ? Storage::disk('products')->url($value)
//                : ($this->images()->where('is_main',true)->first()
//                    ? $this->images()->where('is_main',true)->first()->image
//                    :  asset('main/img/images/no_img_avaliable.jpg')),
        );
    }

    protected function brandTitle(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
        );
    }
}
