<?php

namespace Core;

use Core\Contracts\HasherInterface;
use RuntimeException;

class BcryptHasher implements HasherInterface
{

    public function create(string $plain)
    {
        $hash = password_hash($plain, PASSWORD_BCRYPT, $this->options());

        if (!$hash) {
            throw new RuntimeException('Bcrypt not supported.');
        }

        return $hash;
    }

    public function check(string $plain, string $hash)
    {
        return password_verify($plain, $hash);
    }

    public function needsRehash(string $hash)
    {
        return password_needs_rehash($hash, PASSWORD_BCRYPT, $this->options());
    }

    protected function options()
    {
        return [
            'cost' => 12
        ];
    }
}