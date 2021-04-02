<?php


namespace App\Exceptions;


class ResponseCodeException extends \Exception
{

    public $responseCode;
    public $responseMessage;
    public $data;
    public $info;

    public function __construct($message, int $code, $data = null)
    {
        parent::__construct($message, $code);
        $this->responseCode = $code;
        $this->responseMessage = $message;
        $this->data = $data;
    }
}
