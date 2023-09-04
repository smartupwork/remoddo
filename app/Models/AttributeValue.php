<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributeValue
 * @package App\Models
 * @property string value
 * @property int attribute_id
 */
class AttributeValue extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getAttributeId(): int
    {
        return $this->attribute_id;
    }

    /**
     * @param int $attribute_id
     * @return self
     */
    public function setAttributeId(int $attribute_id): self
    {
        $this->attribute_id = $attribute_id;
        return $this;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withoutGlobalScopes();
    }

}
