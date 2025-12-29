<?php

namespace App\Repositories;

use App\DTOs\FundoDTO;
use App\Enums\TipoFundoEnum;
use App\Enums\TipoParticipanteEnum;
use App\Interfaces\FundoRepositoryInterface;
use App\Models\Fundo;

class FundoRepository implements FundoRepositoryInterface
{
    public function __construct(protected Fundo $model) {}

    public function listarFundos(): array
    {
        return $this->model
            ->select(['id', 'nome', 'tipo_fundo'])
            ->get()
            ->toArray();
    }

    public function obterFundoById(string $idFundo): array
    {
        return $this->model
            ->where('id', $idFundo)
            ?->first()
            ->toArray() ?? [];
    }

    public function buscarFundosRendaFixa(): array
    {
        return $this->model
            ->where('tipo_fundo', TipoFundoEnum::RENDA_FIXA->value)
            ->get()
            ->toArray();
    }

    public function buscarFundoParticipantes(): array
    {
        return $this->model
            ->select(['id', 'nome', 'tipo_fundo'])
            ->whereHas('participantes')
            ->with(['participantes' => function ($query) {
                $query->select(['participantes.id', 'participantes.nome', 'participantes.tipo_participante']);
                $query->where('tipo_participante', TipoParticipanteEnum::CUSTODIANTE);
            }])
            ->paginate()
            ->toArray();
    }

    public function criarFundo(FundoDTO $dto): array
    {
        return $this->model
            ->create($dto->toArray())
            ->toArray();
    }

    public function obterFundosInvestimentos(): array
    {
        return $this->model
            ->leftJoin('investimentos', 'fundos.id', '=', 'investimentos.fundo_id')
            ->select('fundos.nome as fundo', 'investimentos.nome as investimento', 'investimentos.valor')
            ->get()
            ->toArray();
    }
}
