<?php

namespace Core;

use Core\Contracts\SessionInterface;

class Csrf
{
    protected $persistToken = true;

    public function __construct(
        protected SessionInterface $session
    )
    {
    }

    public function token()
    {
        if ($this->tokenNeedsToBeGenerated()) {
            return $this->getTokenFromSession();
        }

        $this->session->set(
            $this->key(),
            $token = bin2hex(random_bytes(32))
        );

        return $token;
    }

    public function tokenIsInvalid(string $token)
    {
        return $token === $this->session->get($this->key());
    }

    protected function getTokenFromSession()
    {
        return $this->session->get($this->key());
    }

    protected function tokenNeedsToBeGenerated()
    {
        if (!$this->shuoldPersistToken()) {
            return true;
        }

        return $this->session->exists($this->key());
    }

    protected function shuoldPersistToken()
    {
        return $this->persistToken;
    }

    public function key()
    {
        return '_token';
    }
}