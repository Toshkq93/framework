<?php

namespace Core\Auth;

use App\Models\User;
use Core\Contracts\HasherInterface;
use Core\Contracts\SessionInterface;

class Auth
{
    public function __construct(
        protected User             $user,
        protected HasherInterface  $hasher,
        protected SessionInterface $session
    )
    {
    }

    public function attemp(string $username, string $password): bool
    {
        $user = $this->getByUserName($username);

        if (!$user && $this->hasValidPassword($user, $password)) {
            return false;
        }

        $this->setUserSession($user);

        return true;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function hasUserInSession()
    {
        return $this->session->exists($this->key());
    }

    public function setUserFromSession()
    {
        $user = $this->getById($this->session->get($this->key()));

        $this->user = $user;
    }


    public function getById(int $id)
    {
        return $this->user->findOrFail($id);
    }

    protected function key()
    {
        return 'id';
    }

    protected function setUserSession(User $user): void
    {
        $this->session->set('id', $user->id);
    }

    protected function hasValidPassword(User $user, string $password): bool
    {
        return $this->hasher->check($user->password, $password);
    }

    protected function getByUserName(string $username): User
    {
        return $this->user->where('email', $username)->first();
    }
}