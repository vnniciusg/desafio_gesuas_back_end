<?php
namespace App\Tests\Domain;

use App\Domain\Entity\Cidadao;
use PHPUnit\Framework\TestCase;

class CidadaoTest extends TestCase
{
    public function testGenerateUniqueNis()
    {
        $cidadao = new Cidadao('Teste');

        $nis = $cidadao->generateUniqueNis();

        $this->assertNotEmpty($nis);
        $this->assertIsString($nis);
        $this->assertMatchesRegularExpression('/^\d{11}$/', $nis);
    }

    public function testNomeNaoNulo()
    {
        $this->expectException(\InvalidArgumentException::class);
        $cidadao = new Cidadao(null);
    }
}