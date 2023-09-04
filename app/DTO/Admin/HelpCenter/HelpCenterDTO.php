<?php


namespace App\DTO\Admin\HelpCenter;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class HelpCenterDTO implements DTOInterface
{

    private string $question;
    private string $answer;
    private string $meta_title;
    private string $meta_description;
    private string $meta_keyword;
    private int $category_id;
    private ?bool $is_active;

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     * @return HelpCenterDTO
     */
    public function setQuestion(string $question): HelpCenterDTO
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
     * @return HelpCenterDTO
     */
    public function setAnswer(string $answer): HelpCenterDTO
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
     * @return HelpCenterDTO
     */
    public function setMetaTitle(string $meta_title): HelpCenterDTO
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
     * @return HelpCenterDTO
     */
    public function setMetaDescription(string $meta_description): HelpCenterDTO
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
     * @return HelpCenterDTO
     */
    public function setMetaKeyword(string $meta_keyword): HelpCenterDTO
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
     * @return HelpCenterDTO
     */
    public function setCategoryId(int $category_id): HelpCenterDTO
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
     * @return HelpCenterDTO
     */
    public function setIsActive(?bool $is_active): HelpCenterDTO
    {
        $this->is_active = $is_active;
        return $this;
    }

    public function make(FormRequest $request)
    {
        return $this->setQuestion($request->get('question'))
            ->setAnswer($request->get('answer'))
            ->setMetaTitle($request->get('meta_title'))
            ->setMetaDescription($request->get('meta_description'))
            ->setMetaKeyword($request->get('meta_keyword'))
            ->setCategoryId($request->get('category_id'))
            ->setIsActive($request->get('is_active') === 'on');
    }
}
