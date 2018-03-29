<?php

namespace App\Ptrio\MessageBundle\Entity;

use App\Ptrio\MessageBundle\Model\Device as BaseDevice;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     */
    protected $name = '';

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $token = '';

    /**
     * @ORM\ManyToOne(targetEntity="App\Ptrio\MessageBundle\Model\UserInterface")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
}