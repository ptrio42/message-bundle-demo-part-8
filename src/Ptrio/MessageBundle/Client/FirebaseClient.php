<?php

namespace App\Ptrio\MessageBundle\Client;

use GuzzleHttp\Client;

class FirebaseClient extends Client implements ClientInterface
{
    public function __construct(string $apiURL, string $serverKey)
    {
        parent::__construct([
           'base_uri' => $apiURL,
            'headers' => [
                'Authorization' => 'key='.$serverKey,
            ],
        ]);
    }

    public function sendMessage(string $messageBody, string $recipient): string
    {
        $response = $this->post('/fcm/send', [
            'json' => [
                'to' => $recipient,
                'notification' => [
                    'body' => $messageBody,
                ],
            ],
        ]);

        return (string) $response->getBody();
    }
}