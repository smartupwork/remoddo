<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class self
 * @package App\Models
 * @property string name
 * @property string location
 * @property string country
 * @property string city
 * @property string post_code
 * @property ?string additional_location
 * @property string phone
 * @property int user_id
 * @property ?boolean is_main
 */
class Address extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_main' => 'boolean',
        'created_at' => 'date:Y-m-d H:i:s'
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return self
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return self
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return self
     */
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsMain(): ?bool
    {
        return $this->is_main;
    }

    /**
     * @param bool|null $is_main
     * @return self
     */
    public function setIsMain(?bool $is_main): self
    {
        $this->is_main = $is_main;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->post_code;
    }

    /**
     * @param string $post_code
     * @return Address
     */
    public function setPostCode(string $post_code): Address
    {
        $this->post_code = $post_code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdditionalLocation(): ?string
    {
        return $this->additional_location;
    }

    /**
     * @param string|null $additional_location
     * @return Address
     */
    public function setAdditionalLocation(?string $additional_location): Address
    {
        $this->additional_location = $additional_location;
        return $this;
    }
}
