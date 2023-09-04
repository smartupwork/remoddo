<?php


namespace App\DTO\Main;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class UserUpdateDetailDTO implements DTOInterface
{
    private string $name;
    private string $surname;
    private string $email;
    private ?UploadedFile $avatar = null;

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
    public function getSurname(): string
    {
        return $this->surname;
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
     * @return UploadedFile|null
     */
    public function getAvatar(): ?UploadedFile
    {
        return $this->avatar;
    }

    /**
     * @param UploadedFile|null $avatar
     * @return self
     */
    public function setAvatar(?UploadedFile $avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }


    public function make(FormRequest $request)
    {
        return $this->setName($request->get('name'))
            ->setSurname($request->get('surname'))
            ->setEmail($request->get('email'))
            ->setAvatar($request->file('avatar'));
    }
}
