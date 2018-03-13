<?php

namespace App\Ptrio\MessageBundle\Client;

interface ClientInterface
{
    public function sendMessage(string $messageBody, string $recipient);
}