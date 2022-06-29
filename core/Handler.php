<?php

namespace Core;

use Core\Contracts\SessionInterface;
use Exception;
use Laminas\Diactoros\Response\RedirectResponse;
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

    /**
     * @return Exception|mixed
     * @throws Exception
     */
    public function response()
    {
        if (method_exists($this, $method = "handle{$this->class}")) {
            return $this->{$method}($this->exception);
        }

        return $this->unhandleException($this->exception);
    }

    /**
     * @param Exception $exception
     */
    protected function handleValidationException(Exception $exception)
    {
        $this->session->set([
            'errors' => $exception->getErrors(),
            'old' => $exception->getoldInput()
        ]);
        // TODO: refactor
        return header('Location:' . $exception->getPath());
    }

    /**
     * @param Exception $exception
     * @return mixed
     * @throws Exception
     */
    protected function unhandleException(Exception $exception): Exception
    {
        throw $exception;
    }
}