<?php

namespace App\Ptrio\MessageBundle\Repository;
use Doctrine\Common\Persistence\ObjectRepository;

interface DeviceRepositoryInterface extends ObjectRepository
{
    public function findDevicesByNames(array $deviceNames): array;
}