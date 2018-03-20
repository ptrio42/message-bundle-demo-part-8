<?php

namespace App\Ptrio\MessageBundle\Doctrine;
use App\Ptrio\MessageBundle\Model\DeviceInterface;
use App\Ptrio\MessageBundle\Model\MessageInterface;
use App\Ptrio\MessageBundle\Model\MessageManager as BaseMessageManager;
use Doctrine\Common\Persistence\ObjectManager;

class MessageManager extends BaseMessageManager
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
     * MessageManager constructor.
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
     * @param MessageInterface $message
     */
    public function updateMessage(MessageInterface $message)
    {
        $this->objectManager->persist($message);
        $this->objectManager->flush();
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param DeviceInterface $device
     * @return array
     */
    public function findMessagesByDevice(DeviceInterface $device): array
    {
        return $this->repository->findBy(['device' => $device]);
    }
}