<?php

namespace Core\Contracts;

interface HasherInterface
{
    public function create(string $plain);

    public function check(string $passwordHash, string $password);

    public function needsRehash(string $hash);
}