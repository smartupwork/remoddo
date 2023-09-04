<?php


namespace App\DTO\Security;

use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class LoginDTO implements DTOInterface
{

    private string $email;
    private string $password;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }


    public function make(FormRequest $request)
    {
        return $this->setEmail($request->get('email'))
            ->setPassword($request->get('password'));
    }
}
