<?php

namespace Core;

use Core\Contracts\SessionInterface;
use Exception;
use ReflectionClass;

class Handler
{
    private $class;

    public function __construct(
        protected Exception $exception,
        protected SessionInterface $session
    )
    {
        $this->class = (new ReflectionClass($this->exception))->getShortName();
    }

    public function response()
    {
        if (method_exists($this, $method = "handle{$this->class}")) {
            return $this->{$method}($this->exception);
        }

        return $this->unhandleException($this->exception);
    }

    protected function handleValidationException(Exception $exception)
    {
        $this->session->set([
            'errors' => $exception->getErrors(),
            'old' => $exception->getoldInput()
        ]);

        return redirect($exception->getPath());
    }

    protected function unhandleException(Exception $exception)
    {
        throw $exception;
    }
}