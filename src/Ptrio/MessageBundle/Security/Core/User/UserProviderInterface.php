<?php

namespace App\Ptrio\MessageBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface as BaseUserProviderInterface;

interface UserProviderInterface extends BaseUserProviderInterface
{
    /**
     * @param string $apiKey
     * @return null|UserInterface
     */
    public function findUser(string $apiKey): ?UserInterface;
}