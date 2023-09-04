<?php

namespace App\DTO\Admin\Product;

use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class ProductDTO implements DTOInterface
{
    private string $title;
    private int $period_day;
    private float $price;
    private string $brand_confirmation;
    private int $brand_id;
    private array $category_id;
    private string $description;
    private string $address;
    private ?array $images = [];
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
     * @return int
     */
    public function getPeriodDay(): int
    {
        return $this->period_day;
    }

    /**
     * @param int $period_day
     * @return self
     */
    public function setPeriodDay(int $period_day): self
    {
        $this->period_day = $period_day;
        return $this;
    }


    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrandConfirmation(): string
    {
        return $this->brand_confirmation;
    }

    /**
     * @param string $brand_confirmation
     * @return self
     */
    public function setBrandConfirmation(string $brand_confirmation): self
    {
        $this->brand_confirmation = $brand_confirmation;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brand_id;
    }

    /**
     * @param int $brand_id
     * @return self
     */
    public function setBrandId(int $brand_id): self
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


    public function make(FormRequest $request)
    {
        return $this->setTitle($request->get('title'))
            ->setPrice($request->get('price'))
            ->setPeriodDay($request->get('period_day'))
            ->setDescription($request->get('description'))
            ->setAddress($request->get('address'))
            ->setCategoryId($request->get('category_id'))
            ->setBrandId($request->get('brand_id'))
            ->setImages($request->file('images'))
            ->setBrandConfirmation($request->get('brand_confirmation'))
            ->setAttributes($request->get('attribute'));
    }
}
