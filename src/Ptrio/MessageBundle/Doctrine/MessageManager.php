<?php

namespace App\Ptrio\MessageBundle\Doctrine;
use App\Ptrio\MessageBundle\Model\DeviceInterface;
use App\Ptrio\MessageBundle\Model\MessageInterface;
use App\Ptrio\MessageBundle\Model\MessageManager as BaseMessageManager;
use App\Ptrio\MessageBundle\Repository\MessageRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MessageManager extends BaseMessageManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var MessageRepositoryInterface
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
     * @param MessageRepositoryInterface $repository
     */
    public function __construct(
        ObjectManager $objectManager,
        string $class,
        MessageRepositoryInterface $repository
    )
    {
        $this->objectManager = $objectManager;
        $this->repository = $repository;
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
     * {@inheritdoc}
     */
    public function findMessagesByDevice(DeviceInterface $device, string $sort, int $offset, int $limit): array
    {
        return $this->repository->findMessagesByDevice($device, $sort, $offset, $limit);
    }
}