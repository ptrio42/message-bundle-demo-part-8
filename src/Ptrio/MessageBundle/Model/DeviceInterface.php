<?php

namespace App\Ptrio\MessageBundle\Model;

interface DeviceInterface
{
    public function getId(): int;

    public function setName(?string $name);

    public function getName(): string;

    public function setToken(?string $token);

    public function getToken(): string;

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user);

    /**
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface;
}