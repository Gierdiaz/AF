<?php

namespace App\Actions;

use App\DTOs\FundoDTO;
use App\Interfaces\FundoRepositoryInterface;

class CriarFundoAction
{
    public function __construct(protected FundoRepositoryInterface $repository) {}

    public function execute(FundoDTO $dto): array
    {
        return $this->repository->criarFundo($dto);
    }
}