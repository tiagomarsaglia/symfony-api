<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PessoaFisicaControllerTest extends WebTestCase
{

    protected $faker;

    protected function setUp(): void
    {
        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Person($this->faker));
        parent::setUp();
    }

    public function testIndex(): void
    {
        $response = static::createClient()->request('GET', '/pessoa/fisica');
               $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    public function testCreatePessoaFisica(): void
    {
        $data = [
            'cpf' => $this->faker->cpf(false),
            'nome' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'senha' => $this->faker->password(6, 10),
        ];
        $this->client = static::createClient();
        $this->client->request(
            'POST',
            '/pessoa/fisica/create',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data)
        );
        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
    }
}
