<?php
namespace App\Tests\Repository;

use App\Domain\Entity\Cidadao;
use App\Infrastructure\Persistence\CidadaoRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class CidadaoRepositoryTest extends TestCase
{
    public function testSalvarCidadao()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $entityManager->expects($this->once())
            ->method('persist');

        $entityManager->expects($this->once())
            ->method('flush');

        $repository = new CidadaoRepository($entityManager);

        $cidadao = $this->createMock(Cidadao::class);
        $result = $repository->salvarCidadao($cidadao);

        $this->assertTrue($result);
    }

    public function testBuscarCidadaoPorNis()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $repository = $this->createMock(\Doctrine\Persistence\ObjectRepository::class);

        $entityManager->expects($this->once())
            ->method('getRepository')
            ->willReturn($repository);

        $repository->expects($this->once())
            ->method('findOneBy')
            ->willReturn(new Cidadao("João da Silva"));

        $repository = new CidadaoRepository($entityManager);

        $result = $repository->buscarCidadaoPorNis('12345678901');

        $this->assertInstanceOf(Cidadao::class, $result);
    }
}