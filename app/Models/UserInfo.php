<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserInfo
 * @package App\Models
 * @property string name
 * @property string surname
 * @property string avatar
 * @property string about
 * @property string address
 * @property boolean is_blocked
 */
class UserInfo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $appends = ['full_name'];

    protected $casts = [
        'is_blocked' => 'bool'
    ];

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
     * @param string $surname
     * @return self
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return self
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbout(): string
    {
        return $this->about;
    }

    /**
     * @param string $about
     * @return self
     */
    public function setAbout(string $about): self
    {
        $this->about = $about;
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
     * @return bool
     */
    public function isIsBlocked(): bool
    {
        return $this->is_blocked;
    }

    /**
     * @param bool $is_blocked
     * @return self
     */
    public function setIsBlocked(bool $is_blocked): self
    {
        $this->is_blocked = $is_blocked;
        return $this;
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value) ? (!filter_var($value, FILTER_VALIDATE_URL)
            ? Storage::disk($this->getDiskName())->url($value)
            : $value)
            : asset('main/img/images/avatar.png')
            ,
        );
    }

    public function getDiskName()
    {
        return 'user';
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => "{$this->getName()} {$this->getSurname()}",
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

}
