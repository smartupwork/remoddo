<?php


namespace App\DTO\Admin\Category;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CategoryDTO implements DTOInterface
{

    private string $title;
    private ?int $parent_id;
    private ?bool $is_show;
    private ?bool $is_popular;
    private ?UploadedFile $image = null;

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


    /**
     * @return UploadedFile|null
     */
    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    /**
     * @param UploadedFile|null $image
     * @return self
     */
    public function setImage(?UploadedFile $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function make(FormRequest $request)
    {
        $parent_id = $request->get('parent_id') ?? null;
        return $this->setTitle($request->get('title'))
            ->setIsShow($request->get('is_show') === 'on')
            ->setIsPopular($request->get('is_popular') === 'on')
            ->setImage($request->file('image'))
            ->setParentId($parent_id);
    }
}
