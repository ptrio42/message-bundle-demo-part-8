<?php

namespace App\Ptrio\MessageBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

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
}