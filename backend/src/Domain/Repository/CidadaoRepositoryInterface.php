<?php
namespace App\Domain\Repository;

use App\Domain\Entity\Cidadao;


interface CidadaoRepositoryInterface
{
    public function salvarCidadao(Cidadao $cidadao) : ?Cidadao;
    public function buscarCidadaoPorNis(string $nis) : ?Cidadao;
}