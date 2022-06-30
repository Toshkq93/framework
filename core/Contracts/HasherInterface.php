<?php

namespace Core\Contracts;

interface HasherInterface
{
    public function create(string $plain);

    public function check(string $plain, string $hash);

    public function needsRehash(string $hash);
}