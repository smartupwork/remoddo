<?php

namespace App\Models;

use App\Utils\Filters\FilterBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Brand
 * @package App\Models
 * @property string title
 * @property string image
 * @property ?boolean is_show=false
 */
class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_show' => 'boolean',
        'created_at' => 'date:Y-m-d H:i:s'
    ];

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

    public function products()
    {
        return $this->hasMany(Product::class)->withoutGlobalScopes();
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utils\Filters\BrandFilter';
        $filter = new FilterBuilder($query, $filters, $namespace);
        return $filter->apply();
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Storage::disk($this->getDiskName())->url($value),
        );
    }

    public function getDiskName()
    {
        return 'brands';
    }
}
