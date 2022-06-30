<?php

namespace Core\Exceptions;

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

    public function getPath()
    {
        return $this->request->getServerParams()['HTTP_REFERER'];
    }

    public function getOldInput()
    {
        return $this->request->getParsedBody();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}