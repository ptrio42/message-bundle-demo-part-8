<?php

namespace App\Ptrio\MessageBundle\Entity;

use App\Ptrio\MessageBundle\Model\Message as BaseMessage;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Message extends BaseMessage
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $body;
    /**
     * @ORM\ManyToOne(targetEntity="Device")
     * @ORM\JoinColumn(name="device_id", referencedColumnName="id")
     */
    protected $device;
    /**
     * @ORM\Column(type="date")
     */
    protected $sentAt;
}