<?php

namespace App\Exceptions;

use Exception;

class InvalidTokenException extends Exception
{
    public function __construct($message , $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json(['error' => $this->getMessage()], 500);
    }
}
