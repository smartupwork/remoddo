<?php


namespace App\DTO\Security;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RegistrationDTO implements DTOInterface
{

    private string $email;
    private string $password;
    private string $name;
    private string $surname;
    private ?UploadedFile $avatar = null;

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

        return $this->setEmail($request->get('email'))
            ->setPassword($request->get('password'))
            ->setName($request->get('name'))
            ->setSurname($request->get('surname'))
            ->setAvatar($request->file('avatar'));
    }
}
