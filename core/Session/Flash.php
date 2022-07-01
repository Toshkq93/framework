<?php

namespace Core\Session;

use Core\Contracts\SessionInterface;

class Flash
{
    protected $messages;

    public function __construct(
        protected SessionInterface $session
    )
    {
        $this->loadFlashMessagesIntoCache();

        $this->clear();
    }

    public function get($key)
    {
        if ($this->has($key)){
            return $this->messages[$key];
        }

        return null;
    }

    public function has($key)
    {
        return isset($this->messages[$key]);
    }

    public function set($key, $value)
    {
        $this->session->set('flash', array_merge(
            $this->session->get('flash') ?? [],
            [
                $key => $value
            ]
        ));
    }

    protected function getAll()
    {
        return $this->session->get('flash');
    }

    protected function loadFlashMessagesIntoCache()
    {
        $this->messages = $this->getAll();
    }

    protected function clear()
    {
        $this->session->clear('flash');
    }
}