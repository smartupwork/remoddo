<?php


namespace App\DTO\Main;

use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class SaveChatDTO implements DTOInterface
{
    private string $message;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function make(FormRequest $request)
    {
        return $this->setMessage($request->get('message'));
    }
}
