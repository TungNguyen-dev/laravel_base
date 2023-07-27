<?php

namespace TungNN\LaravelBase;

class ErrorMessage
{
    /**
     * Used for find a matchable message in pre-defined messages.
     *
     * @var string
     */
    private string $code;

    /**
     * A string describe problem of request in response.
     *
     * @var string
     */
    private string $message;

    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
        $this->message = $this->findMessageByCode($code);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Find matchable message by code in pre-defined messages.
     *
     * @param string $code
     * @return string
     */
    protected function findMessageByCode(string $code): string
    {
        return $code;
    }
}
