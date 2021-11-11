<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class NotificationService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function checkNotification(): bool
    {
        $response = $this->client->request(
            'GET',
            'http://o4d9z.mocklab.io/notify'
        );

        $statusCode = $response->getStatusCode();

        return 200 === $statusCode;
    }
}
