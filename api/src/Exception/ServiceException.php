<?php

namespace App\Exception;

use Symfony\Component\Config\Definition\Exception\Exception;
use Throwable;

class ServiceException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}