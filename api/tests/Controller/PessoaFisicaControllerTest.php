<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PessoaFisicaControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $response = static::createClient()->request('GET', '/pessoa/fisica');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    // public function testCreatePessoaFisica(): void
    // {
    //     $response = static::createClient()->request(
    //         'POST',
    //         '/pessoa/fisica/create',
    //         [],
    //         [],
    //         ['CONTENT_TYPE' => 'application/json'],
    //         '{"cpf":"12345678909","body":"body1"}'
    //     );

    //     $this->assertResponseIsSuccessful();
    //     $this->assertResponseHeaderSame('Content-Type', 'application/json');
    // }
}
