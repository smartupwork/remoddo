<?php


namespace App\DTO\Admin\User;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateDTO implements DTOInterface
{

    private ?string $email;
    private ?string $address;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return self
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }


    /**
     * @param FormRequest $request
     */
    public function make(FormRequest $request)
    {
        return $this->setEmail($request->get('email'))
            ->setAddress($request->get('address'));
    }
}
