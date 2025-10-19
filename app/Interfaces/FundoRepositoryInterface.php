<?php

namespace App\Interfaces;

use App\DTOs\FundoDTO;

interface FundoRepositoryInterface
{
    public function listarFundos(): array;

    public function obterFundoById(string $idFundo): array;

    public function buscarFundosRendaFixa(): array;

    public function buscarFundoParticipantes(): array;

    public function criarFundo(FundoDTO $dto): array;
}
