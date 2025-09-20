<?php

namespace App\Repositories;

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
}
