<?php


namespace App\Handler\Service;

use App\Contract\Handler\HandlerContract;

class HandlerService
{
    private HandlerContract $handler;

    /**
     * @return HandlerContract
     */
    public function getHandler(): HandlerContract
    {
        return $this->handler;
    }

    /**
     * @param HandlerContract $handler
     * @return self
     */
    public function setHandler(HandlerContract $handler): self
    {
        $this->handler = $handler;
        return $this;
    }


}
