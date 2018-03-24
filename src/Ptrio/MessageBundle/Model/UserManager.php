<?php

namespace App\Ptrio\MessageBundle\Model;

abstract class UserManager implements UserManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function createUser()
    {
        $class = $this->getClass();
        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function findUserByUsername(string $username): ?UserInterface
    {
        return $this->findUserBy(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserByApiKey(string $apiKey): ?UserInterface
    {
        return $this->findUserBy(['apiKey' => $apiKey]);
    }
}