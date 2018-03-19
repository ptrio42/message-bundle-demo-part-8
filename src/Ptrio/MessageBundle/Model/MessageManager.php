<?php

namespace App\Ptrio\MessageBundle\Model;

abstract class MessageManager implements MessageManagerInterface
{
    public function createMessage(): MessageInterface
    {
        $class = $this->getClass();
        return new $class;
    }
}