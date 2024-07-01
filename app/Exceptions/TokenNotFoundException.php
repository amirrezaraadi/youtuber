<?php

namespace App\Exceptions;

use Exception;

class TokenNotFoundException extends Exception
{
    public function __construct($message = "Token not found.", $code = 401, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json(['error' => $this->getMessage()], $this->code);
    }
}
