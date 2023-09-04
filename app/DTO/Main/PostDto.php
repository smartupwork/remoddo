<?php


namespace App\DTO\Main;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class PostDto implements DTOInterface
{

    private string $title;
    private string $gender;
    private string $address;
    private string $description;
    private int|string $brand_id;
    private array $category_id;
    private ?array $images = [];
    private ?array $is_main = [];
    private array $rents;
    private ?array $tags = [];
    private array $attributes;

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
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return self
     */
    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }



    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return self
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int|string
     */
    public function getBrandId(): int|string
    {
        return $this->brand_id;
    }

    /**
     * @param int|string $brand_id
     * @return self
     */
    public function setBrandId(int|string $brand_id): self
    {
        $this->brand_id = $brand_id;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategoryId(): array
    {
        return $this->category_id;
    }

    /**
     * @param array $category_id
     * @return self
     */
    public function setCategoryId(array $category_id): self
    {
        $this->category_id = $category_id;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getImages(): ?array
    {
        return $this->images;
    }

    /**
     * @param array|null $images
     * @return self
     */
    public function setImages(?array $images): self
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return array
     */
    public function getRents(): array
    {
        return $this->rents;
    }

    /**
     * @param array $rents
     * @return self
     */
    public function setRents(array $rents): self
    {
        $this->rents = $rents;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array|null $tags
     * @return self
     */
    public function setTags(?array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return self
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getIsMain(): ?array
    {
        return $this->is_main;
    }

    /**
     * @param array|null $is_main
     * @return self
     */
    public function setIsMain(?array $is_main): self
    {
        $this->is_main = $is_main;
        return $this;
    }




    public function make(FormRequest $request)
    {
        return $this->setTitle($request->get('title'))
            ->setGender($request->get('gender'))
            ->setAddress($request->get('address'))
            ->setDescription($request->get('description'))
            ->setBrandId($request->get('brand_id'))
            ->setCategoryId($request->get('category_id'))
            ->setRents($request->get('rents'))
            ->setImages($request->file('images'))
            ->setIsMain($request->get('is_main'))
            ->setAttributes($request->get('attribute'))
            ->setTags($request->get('tag'));
    }
}
