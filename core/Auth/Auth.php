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

    public function attemp(string $username, string $password)
    {
        $user = $this->getByUserName($username);

        if (!$user or !$this->hasValidPassword($user->password, $password)) {

            return false;
        }

        if ($this->NeedRehash($user)) {
            $this->rehashPassword($user);
        }

        $this->setUserSession($user);

        return true;
    }

    public function user()
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

    public function check()
    {
        return $this->hasUserInSession();
    }

    protected function rehashPassword(User $user)
    {
        $this->user
            ->findOrFail($user->id)
            ->update([
                'password' => $this->hasher->create($user->password)
            ]);
    }

    protected function NeedRehash(User $user)
    {
        return $this->hasher->needsRehash($user->password);
    }

    protected function key()
    {
        return 'id';
    }

    protected function setUserSession(User $user)
    {
        $this->session->set('id', $user->id);
    }

    protected function hasValidPassword(string $passwordHash, string $password)
    {
        return $this->hasher->check($passwordHash, $password);
    }

    protected function getByUserName(string $username)
    {
        return $this->user
            ->where('email', $username)
            ->first();
    }
}