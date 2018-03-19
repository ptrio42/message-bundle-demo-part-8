<?php

namespace App\Ptrio\MessageBundle\Model;

abstract class Message implements MessageInterface
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $body;
    /**
     * @var DeviceInterface
     */
    protected $device;
    /**
     * @var \DateTime
     */
    protected $sentAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /**
     * @param DeviceInterface $device
     */
    public function setDevice(DeviceInterface $device)
    {
        $this->device = $device;
    }

    /**
     * @return \DateTime|null
     */
    public function getSentAt(): ?\DateTime
    {
        return $this->sentAt;
    }
    
    /**
     * @param \DateTime $sentAt
     */
    public function setSentAt(\DateTime $sentAt)
    {
        $this->sentAt = $sentAt;
    }
}