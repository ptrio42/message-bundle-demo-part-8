<?php

namespace App\Ptrio\MessageBundle\Security\Voter;

use App\Ptrio\MessageBundle\Model\DeviceInterface;
use App\Ptrio\MessageBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class DeviceVoter extends Voter
{
    /**
     * {@inheritdoc}
     */
    protected function supports($attribute, $subject)
    {
        return $subject instanceof DeviceInterface;
    }

    /**
     * {@inheritdoc}
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        /** @var DeviceInterface $device */
        $device = $subject;

        return $device->getUser() === $user;
    }
}