<?php

namespace App\Exceptions;

use Exception;
use Laminas\Diactoros\ServerRequest;

class ValidationException extends Exception
{
    public function __construct(
        private ServerRequest $request,
        private array         $errors
    )
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/auth/login';
    }

    /**
     * @return array
     */
    public function getOldInput(): array
    {
        return $this->request->getParsedBody();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}