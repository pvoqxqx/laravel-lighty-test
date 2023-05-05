<?php

declare(strict_types = 1);

namespace Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\Exceptions;

use RuntimeException;
use Throwable;

class UndefinedReturnTypeException extends RuntimeException
{
    public function __construct(string $message = "Undefined return type.", int $code = 400, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
