<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransacaoControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $response = static::createClient()->request('GET', '/usuarios');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }
}
