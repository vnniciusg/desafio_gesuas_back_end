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

    public function salvarCidadao(Cidadao $cidadao) : ?Cidadao
    {
        try{
            $this->entityManager->persist($cidadao);
            $this->entityManager->flush();
            return $cidadao;
        }catch(\Exception $e){
            return null;
        }
        
    }


    public function buscarCidadaoPorNis(string $nis) : ?Cidadao
    {
        try{
            return $this->entityManager->getRepository(Cidadao::class)->findOneBy(['nis' => $nis]);
        }catch(\Exception $e){
            return null;
        }
    }

    public function __toString()
    {
        return 'CidadaoRepository';
    }
}