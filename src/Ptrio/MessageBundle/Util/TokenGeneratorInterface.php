<?php

namespace App\Ptrio\MessageBundle\Util;

interface TokenGeneratorInterface
{
    /**
     * @return string
     */
    public function generateToken(): string;
}