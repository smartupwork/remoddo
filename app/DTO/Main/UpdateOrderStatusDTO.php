<?php


namespace App\DTO\Main;

use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusDTO implements DTOInterface
{
    private string $status;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function make(FormRequest $request)
    {
        return $this->setStatus($request->status);
    }
}
