<?php

namespace App\Models;

use App\Utils\Filters\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Brand
 * @package App\Models
 * @property string title
 * @property ?boolean is_show=false
 */
class Tag extends Model
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
     * @return bool|null
     */
    public function getIsShow(): ?bool
    {
        return $this->is_show;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withoutGlobalScopes();
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

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utils\Filters\TagFilter';
        $filter = new FilterBuilder($query, $filters, $namespace);
        return $filter->apply();
    }
}
