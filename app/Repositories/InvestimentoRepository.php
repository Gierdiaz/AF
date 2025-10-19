<?php

namespace App\Repositories;

use App\Interfaces\InvestimentoRepositoryInterface;
use App\Models\Investimento;

class InvestimentoRepository implements InvestimentoRepositoryInterface
{

    public function __construct(protected Investimento $model) {}

    // public function listarInvestimentos(): array
    // {
    //     return $this->model
    //         ->join('fundos', 'fundos.id', '=', 'investimentos.fundo_id')
    //         ->select([   
    //             'investimentos.nome as investimento',
    //             'investimentos.tipo_investimento as tipo_investimento',
    //             'investimentos.valor as valor',
    //             'fundos.nome as fundo'
    //         ])
    //         ->get()
    //         ->toArray();
    // }

    public function listarInvestimentos(): array
    {
        return $this->model
            ->select([
                'investimentos.id', 'investimentos.nome', 
                'investimentos.tipo_investimento', 
                'investimentos.valor',
                'fundo_id' // Precisa selecionar o campo fundo_id para o with funcionar
            ])
            ->with('fundo:id,nome,tipo_fundo')
            ->get()
            ->makeHidden('fundo_id') // Ocultar o campo fundo_id
            ->toArray();
    }
}