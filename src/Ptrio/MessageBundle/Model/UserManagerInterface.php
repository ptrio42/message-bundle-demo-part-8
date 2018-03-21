<?php

namespace App\Ptrio\MessageBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface UserManagerInterface
{
    /**
     * @return UserInterface
     */
    public function createUser();

    /**
     * @param UserInterface $user
     */
    public function updateUser(UserInterface $user);

    /**
     * @param UserInterface $user
     */
    public function removeUser(UserInterface $user);

    /**
     * @param array $criteria
     * @return null|UserInterface
     */
    public function findUserBy(array $criteria): ?UserInterface;

    /**
     * @param string $username
     * @return null|UserInterface
     */
    public function findUserByUsername(string $username): ?UserInterface;

    /**
     * @return string
     */
    public function getClass(): string;
}