<?php
namespace App\Tests\Domain;

use App\Domain\Entity\Cidadao;
use PHPUnit\Framework\TestCase;

class CidadaoTest extends TestCase
{
    public function testCidadao()
    {
        $cidadao = new Cidadao('João da Silva');
        $this->assertEquals('João da Silva', $cidadao->getNome());
        $this->assertNotEmpty($cidadao->getNis());
        $this->assertIsString($cidadao->getNis());
    }

    public function testNisGeneration(){
        $cidadao = new Cidadao('João da Silva');

        $nis = $cidadao->getNis();

        $this->assertNotEmpty($nis);
        $this->assertIsString($nis);
        $this->assertMatchesRegularExpression('/^\d{11}$/', $nis);
    }
}