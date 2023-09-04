<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Category
 * @package App\Models
 * @property string title
 * @property string slug
 * @property string image
 * @property ?int parent_id=null
 * @property ?bool is_show=false
 * @property ?bool is_popular=false
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_show' => 'boolean',
        'is_popular' => 'boolean',
        'created_at' => 'date:Y-m-d H:i:s'
    ];

    protected static function boot()
    {
        parent::boot();

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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    /**
     * @param int|null $parent_id
     * @return self
     */
    public function setParentId(?int $parent_id): self
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsShow(): ?bool
    {
        return $this->is_show;
    }

    /**
     * @param bool|null $is_show
     * @return self
     */
    public function setIsShow(?bool $is_show): self
    {
        $this->is_show = $is_show;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPopular(): ?bool
    {
        return $this->is_popular;
    }

    /**
     * @param bool|null $is_popular
     * @return self
     */
    public function setIsPopular(?bool $is_popular): self
    {
        $this->is_popular = $is_popular;
        return $this;
    }

    public function uniqueProducts()
    {
        return $this->products()->with(['brand', 'images', 'likes'])
            ->groupBy('category_id', 'product_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->where('status', ProductStatus::ACTIVE)->withoutGlobalScopes();
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->withCount('products');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Storage::disk($this->getDiskName())->url($value),
        );
    }

    public function getDiskName()
    {
        return 'categories';
    }


}
