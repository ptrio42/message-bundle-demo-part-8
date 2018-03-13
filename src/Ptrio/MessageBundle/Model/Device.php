<?php

namespace App\Ptrio\MessageBundle\Model;

abstract class Device implements DeviceInterface
{
    protected $id;

    protected $name;

    protected $token;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }
}