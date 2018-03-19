<?php

namespace App\Ptrio\MessageBundle\Model;

interface MessageInterface
{
    public function getId(): int;

    public function setBody(string $body);

    public function getBody(): string;

    public function setDevice(DeviceInterface $device);

    public function getDevice(): DeviceInterface;

    public function setSentAt(\DateTime $sentAt);

    public function getSentAt(): ?\DateTime;
}