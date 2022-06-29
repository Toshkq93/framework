<?php

namespace Core\Contracts;

interface LoaderInterface
{
    /**
     * @return array
     */
    public function parse(): array;
}