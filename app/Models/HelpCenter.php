<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HelpCenter
 * @package App\Models
 * @property string question
 * @property string answer
 * @property string meta_title
 * @property string meta_description
 * @property string meta_keyword
 * @property int category_id
 * @property ?boolean is_active=false
 */
class HelpCenter extends Model
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
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     * @return HelpCenter
     */
    public function setQuestion(string $question): HelpCenter
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     * @return HelpCenter
     */
    public function setAnswer(string $answer): HelpCenter
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaTitle(): string
    {
        return $this->meta_title;
    }

    /**
     * @param string $meta_title
     * @return HelpCenter
     */
    public function setMetaTitle(string $meta_title): HelpCenter
    {
        $this->meta_title = $meta_title;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->meta_description;
    }

    /**
     * @param string $meta_description
     * @return HelpCenter
     */
    public function setMetaDescription(string $meta_description): HelpCenter
    {
        $this->meta_description = $meta_description;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeyword(): string
    {
        return $this->meta_keyword;
    }

    /**
     * @param string $meta_keyword
     * @return HelpCenter
     */
    public function setMetaKeyword(string $meta_keyword): HelpCenter
    {
        $this->meta_keyword = $meta_keyword;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     * @return HelpCenter
     */
    public function setCategoryId(int $category_id): HelpCenter
    {
        $this->category_id = $category_id;
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
     * @return HelpCenter
     */
    public function setIsActive(?bool $is_active): HelpCenter
    {
        $this->is_active = $is_active;
        return $this;
    }

    public function category()
    {
        return $this->belongsTo(HelpCenterCategory::class, 'category_id');
    }
}
