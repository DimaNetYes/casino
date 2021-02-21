<?php


namespace testtask\Exceptions;


use Throwable;
use testtask\View\View;

class InvalidArgumentException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}