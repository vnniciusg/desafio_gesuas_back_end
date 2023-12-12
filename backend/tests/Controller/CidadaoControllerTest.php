<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CidadaoControllerTest extends WebTestCase
{
    public function testCadastrarCidadao() : void
    {
        $client = static::createClient();
        $client->request('POST', '/api/v1/cidadaos/', [], [], [], json_encode(['nome' => 'Vinnicius Santos']));

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('Cidadao cadastrado com sucesso', $responseData['success']);
    
    }

    public function testPesquisarEndpoint()
    {
        $client = static::createClient();
        $nis = '12345678901';

        $client->request('GET', '/api/v1/cidadaos/' . $nis);

        $this->assertContains($client->getResponse()->getStatusCode(), [200, 404]);
        $this->assertJson($client->getResponse()->getContent());

        if ($client->getResponse()->getStatusCode() === 200) {
            $responseData = json_decode($client->getResponse()->getContent(), true);
            $this->assertEquals('Cidadao encontrado', $responseData['success']);
            $this->assertArrayHasKey('data', $responseData);
        } elseif ($client->getResponse()->getStatusCode() === 404) {
            $responseData = json_decode($client->getResponse()->getContent(), true);
            $this->assertEquals('Cidadao nao encontrado', $responseData['error']);
        }
    }
}