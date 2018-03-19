<?php

namespace App\Ptrio\MessageBundle\Model;

interface MessageManagerInterface
{
    public function createMessage(): MessageInterface;

    public function updateMessage(MessageInterface $message);

    public function findMessagesByDevice(DeviceInterface $device): array;

    public function getClass();
}