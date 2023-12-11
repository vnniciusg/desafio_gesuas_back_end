<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Cidadao;
use App\Domain\Repository\CidadaoRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class CidadaoRepository implements CidadaoRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function salvarCidadao(Cidadao $cidadao) : bool
    {
        $this->entityManager->persist($cidadao);
        $this->entityManager->flush();
        return true;
    }


    public function buscarCidadaoPorNis(string $nis) : ?Cidadao
    {
        return $this->entityManager->getRepository(Cidadao::class)->findOneBy(['nis' => $nis]);
    }

    public function __toString()
    {
        return 'CidadaoRepository';
    }
}