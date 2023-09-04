<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attribute
 * @package App\Models
 * @property string title
 * @property string name
 * @property ?bool is_required=false
 * @property ?bool is_show=false
 * @property ?bool is_multiple=false
 * @property ?bool show_in_products_table=false
 */
class Attribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'attributes';

    protected $casts = [
        'is_required' => 'bool',
        'is_show' => 'bool',
        'is_multiple' => 'bool',
        'show_in_products_table' => 'bool',
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): Attribute
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsRequired(): ?bool
    {
        return $this->is_required;
    }

    /**
     * @param bool|null $is_required
     * @return Attribute
     */
    public function setIsRequired(?bool $is_required): Attribute
    {
        $this->is_required = $is_required;
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
    public function getIsMultiple(): ?bool
    {
        return $this->is_multiple;
    }

    /**
     * @param bool|null $is_multiple
     * @return self
     */
    public function setIsMultiple(?bool $is_multiple): self
    {
        $this->is_multiple = $is_multiple;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowInProductsTable(): ?bool
    {
        return $this->show_in_products_table;
    }

    /**
     * @param bool|null $show_in_products_table
     * @return self
     */
    public function setShowInProductsTable(?bool $show_in_products_table): self
    {
        $this->show_in_products_table = $show_in_products_table;
        return $this;
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class)->withCount('products');
    }
}
