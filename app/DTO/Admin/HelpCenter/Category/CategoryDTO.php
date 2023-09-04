<?php


namespace App\DTO\Admin\HelpCenter\Category;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class CategoryDTO implements DTOInterface
{

    private string $title;
    private string $content;
    private ?bool $is_active;

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

    public function make(FormRequest $request)
    {
        return $this->setTitle($request->get('title'))
            ->setContent($request->get('content'))
            ->setIsActive($request->get('is_active') === 'on');
    }
}
