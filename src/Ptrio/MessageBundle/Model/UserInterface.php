<?php

namespace App\Ptrio\MessageBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface
{
    const ROLE_USER = 'ROLE_USER';

    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @param string $username
     */
    public function setUsername(string $username);

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey);

    /**
     * @param string $role
     */
    public function addRole(string $role);

    /**
     * @param string $role
     */
    public function removeRole(string $role);
}