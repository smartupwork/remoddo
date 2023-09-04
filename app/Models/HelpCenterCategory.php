<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HelpCenterCategory
 * @package App\Models
 * @property string title
 * @property string content
 * @property ?boolean is_active=false
 */
class HelpCenterCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    /**
     * @param bool|null $is_active
     * @return self
     */
    public function setIsActive(?bool $is_active): self
    {
        $this->is_active = $is_active;
        return $this;
    }


    public function questions()
    {
        return $this->hasMany(HelpCenter::class, 'category_id')->where('is_active', true);
    }

}
