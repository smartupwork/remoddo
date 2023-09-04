<?php


namespace App\DTO\Main;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePasswordDTO implements DTOInterface
{
    private string $new_password;

    /**
     * @return string
     */
    public function getNewPassword(): string
    {
        return $this->new_password;
    }

    /**
     * @param string $new_password
     * @return self
     */
    public function setNewPassword(string $new_password): self
    {
        $this->new_password = $new_password;
        return $this;
    }


    public function make(FormRequest $request)
    {
        return $this->setNewPassword($request->get('new_password'));
    }
}
