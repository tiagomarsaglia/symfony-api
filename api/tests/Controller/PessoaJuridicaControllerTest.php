<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PessoaJuridicaControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $response = static::createClient()->request('GET', '/pessoa/juridica');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }
}
