<?php


namespace App\DTO\Admin\Tag;

use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class TagDTO implements DTOInterface
{

    private string $title;
    private ?bool $is_show;

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

    /**
     * @param bool|null $is_show
     * @return self
     */
    public function setIsShow(?bool $is_show): self
    {
        $this->is_show = $is_show;
        return $this;
    }


    public function make(FormRequest $request)
    {
        return $this->setTitle($request->get('title'))
            ->setIsShow($request->get('is_show') === 'on');
    }
}
