<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ErrorException extends \RuntimeException
{
    private $data;
    /**
     * ErrorException constructor.
     *
     * @param int $httpCode
     * @param string $message
     * @param null $data
     * @param Throwable|null $previous
     */
    public function __construct(int $httpCode, string $message, $data = null, \Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct($message,$httpCode,$previous);
    }
    public function getData(){
        return $this->data;
    }
    public static function serviceUnavailable(string $message = 'Service unavailable',$data = null):ErrorException{
        return new ErrorException(Response::HTTP_SERVICE_UNAVAILABLE,$message,$data);
    }
    public static function badRequest(string $message = "Bad request",$data=null):ErrorException{
        return new ErrorException(Response::HTTP_BAD_REQUEST,$message,$data);
    }
    public static function forbiden(string $message = 'forbidden',$data = null){
        return new ErrorException(Response::HTTP_FORBIDDEN,$message,$data);
    }
    public static function notFound (string $message = 'Not found',$data=null):ErrorException{
        return new ErrorException(Response::HTTP_NOT_FOUND,$message,$data);
    }
    public static function conflict(string $message = "Conflict", $data = null): ErrorException
    {
        return new ErrorException(Response::HTTP_CONFLICT, $message, $data);
    }
    public static function validation(string $message = "Request invalid", $data = null): ErrorException
    {
        return new ErrorException(Response::HTTP_UNPROCESSABLE_ENTITY, $message, $data);
    }
    public static function invalid (string $message = "Invalid Params",$data = null):ErrorException{
        return new ErrorException(Response::HTTP_BAD_GATEWAY,$message,$data);
    }
    public static function queryFailed (string $message = "Query Failed",$data = null):ErrorException{
        return new ErrorException(Response::HTTP_BAD_REQUEST,$message,$data);
    }
}
