<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransacaoControllerTest extends WebTestCase
{

    protected $faker;

    protected function setUp(): void
    {
        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Person($this->faker));
        $this->client = static::createClient();
        parent::setUp();
    }

    public function testCreateTransacao(): void
    {
        $data = [
            'pagador' => $this->createUsuario(),
            'beneficiario' => $this->createUsuario(),
            'valor' => 20
        ];
        $this->client->request(
            'POST',
            '/transacao',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data)
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }

    private function createUsuario(): int
    {
        $data = [
            'cpf' => $this->faker->cpf(false),
            'nome' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'senha' => $this->faker->password(6, 10),
        ];

        $this->client->request(
            'POST',
            '/pessoa/fisica/create',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data)
        );
        $response = $this->client->getResponse();
        $content = json_decode($response->getContent());
        return (int) $content->id;
    }
}
