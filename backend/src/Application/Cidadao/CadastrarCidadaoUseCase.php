<?php
namespace App\Application\Cidadao;

use App\Domain\Entity\Cidadao;
use App\Domain\Repository\CidadaoRepositoryInterface;

class CadastrarCidadaoUseCase
{
    private $repository;

    public function __construct(CidadaoRepositoryInterface $cidadaoRepository)
    {
        $this->repository = $cidadaoRepository;
    }

    public function cadastrarCidadao(Cidadao $cidadao) : ?Cidadao
    {
        return $this->repository->salvarCidadao($cidadao);
    }
}