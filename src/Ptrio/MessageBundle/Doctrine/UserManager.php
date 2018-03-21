<?php

namespace App\Ptrio\MessageBundle\Doctrine;

use App\Ptrio\MessageBundle\Model\UserManager as BaseUserManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\UserInterface;

class UserManager extends BaseUserManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $class;

    /**
     * UserManager constructor.
     * @param ObjectManager $objectManager
     * @param string $class
     */
    public function __construct(
        ObjectManager $objectManager,
        string $class
    )
    {
        $this->objectManager = $objectManager;
        $this->repository = $objectManager->getRepository($class);

        $metadata = $objectManager->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function updateUser(UserInterface $user)
    {
        $this->objectManager->persist($user);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeUser(UserInterface $user)
    {
        $this->objectManager->remove($user);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findUserBy(array $criteria): ?UserInterface
    {
        /** @var UserInterface|null $user */
        $user = $this->repository->findOneBy($criteria);
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getClass(): string
    {
        return $this->class;
    }
}