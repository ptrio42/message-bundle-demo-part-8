<?php

namespace App\Ptrio\MessageBundle\Doctrine;

use App\Ptrio\MessageBundle\Model\DeviceInterface;
use App\Ptrio\MessageBundle\Model\DeviceManager as BaseDeviceManager;
use Doctrine\Common\Persistence\ObjectManager;

class DeviceManager extends BaseDeviceManager
{
    private $objectManager;
    private $repository;
    private $class;

    public function __construct(ObjectManager $objectManager, string $class)
    {
        $this->objectManager = $objectManager;
        $this->repository = $objectManager->getRepository($class);

        $metadata = $objectManager->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function findDeviceBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function updateDevice(DeviceInterface $device)
    {
        $this->objectManager->persist($device);
        $this->objectManager->flush();
    }

    public function removeDevice(DeviceInterface $device)
    {
        $this->objectManager->remove($device);
        $this->objectManager->flush();
    }
}