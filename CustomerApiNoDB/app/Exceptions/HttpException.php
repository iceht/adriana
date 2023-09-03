<?php

namespace App\Exceptions;

use Exception;

class HttpException extends Exception
{
    private int $status;
    private ?string $body;


    //

    /**
     * @param int $status
     * @param string|null $body
     */
    public function __construct(int $status, ?string $body)
    {
        parent::__construct(message: $body, code: $status);
        $this->status = $status;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }


}
