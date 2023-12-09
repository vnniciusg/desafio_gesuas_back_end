<?php

use App\Domain\Repository\CidadaoRepositoryInterface;

class PesquisarCidadao
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