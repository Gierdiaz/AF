<?php

namespace App\Interfaces;

interface FundoRepositoryInterface
{
    public function listarFundos(): array;

    public function buscarFundosRendaFixa(): array;

    public function buscarFundoParticipantes(): array;
}
