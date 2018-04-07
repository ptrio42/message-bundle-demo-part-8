<?php

namespace App\Ptrio\MessageBundle\Model;

interface MessageManagerInterface
{
    public function createMessage(): MessageInterface;

    public function updateMessage(MessageInterface $message);

    public function findMessagesByDevice(DeviceInterface $device, string $sort, int $offset, int $limit): array;

    public function getClass();
}