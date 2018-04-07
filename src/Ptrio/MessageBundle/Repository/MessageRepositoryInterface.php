<?php

namespace App\Ptrio\MessageBundle\Repository;

use App\Ptrio\MessageBundle\Model\DeviceInterface;
use Doctrine\Common\Persistence\ObjectRepository;

interface MessageRepositoryInterface extends ObjectRepository
{
    /**
     * @param DeviceInterface $device
     * @param string $sort
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function findMessagesByDevice(DeviceInterface $device, string $sort, int $offset, int $limit): array;
}