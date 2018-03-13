<?php

namespace App\Ptrio\MessageBundle\Entity;

use App\Ptrio\MessageBundle\Model\Device as BaseDevice;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Device extends BaseDevice
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
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $token;
}