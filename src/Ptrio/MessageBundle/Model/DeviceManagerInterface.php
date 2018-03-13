<?php

namespace App\Ptrio\MessageBundle\Model;

interface DeviceManagerInterface
{
    public function createDevice(): DeviceInterface;

    public function updateDevice(DeviceInterface $device);

    public function removeDevice(DeviceInterface $device);

    public function getClass(): string;

    public function findDeviceByName(string $name);

    public function findDeviceBy(array $criteria);
}