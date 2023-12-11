<?php
namespace App\Application\Cidadao;

use App\Domain\Repository\CidadaoRepositoryInterface;

class PesquisarCidadaoUseCase
{
    private $repository;

    public function __construct(CidadaoRepositoryInterface $cidadaoRepository)
    {
        $this->repository = $cidadaoRepository;
    }


    public function pesquisarCidadaoPorNis(string $nis)
    {
        return $this->repository->buscarCidadaoPorNis($nis);
    }

}