<?php


namespace App\DTO\Admin\Brand;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BrandDTO implements DTOInterface
{

    private string $title;
    private ?bool $is_show;
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
        return $this->setTitle($request->get('title'))
            ->setIsShow($request->get('is_show') === 'on')
            ->setImage($request->file('image'));
    }
}
