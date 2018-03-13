<?php

namespace App\Ptrio\MessageBundle\Model;

abstract class DeviceManager implements DeviceManagerInterface
{
    public function createDevice(): DeviceInterface
    {
        $class = $this->getClass();
        return new $class;
    }

    public function findDeviceByName(string $name)
    {
        return $this->findDeviceBy(['name' => $name]);
    }
}