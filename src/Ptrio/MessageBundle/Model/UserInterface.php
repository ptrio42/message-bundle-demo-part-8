<?php

namespace App\Ptrio\MessageBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface
{
    /**
     * @param string $username
     */
    public function setUsername(string $username);

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey);
}