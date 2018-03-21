<?php

namespace App\Ptrio\MessageBundle\Security\Core\User;

use App\Ptrio\MessageBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class EntityUserProvider implements UserProviderInterface
{
    /**
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * EntityUserProvider constructor.
     * @param UserManagerInterface $userManager
     */
    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $user = $this->userManager->findUserByUsername($username);

        if ($user instanceof UserInterface) {
            return $user;
        }

        throw new UsernameNotFoundException('User cannot be found for a given username.');
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if ($user instanceof UserInterface) {
            return $this->loadUserByUsername($user->getUsername());
        }

        throw new UnsupportedUserException('Unsupported user instance.');
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $this->userManager->getClass() === $class;
    }
}