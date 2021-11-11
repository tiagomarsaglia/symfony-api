<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class AutorizationService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function checkAutorization(): bool
    {
        $response = $this->client->request(
            'GET',
            'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6'
        );

        $statusCode = $response->getStatusCode();

        return 200 === $statusCode;
    }
}
