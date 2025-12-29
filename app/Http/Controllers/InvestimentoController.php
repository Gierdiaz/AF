<?php

namespace App\Http\Controllers;

use App\Interfaces\InvestimentoRepositoryInterface;

class InvestimentoController extends Controller
{
    public function __construct(protected InvestimentoRepositoryInterface $repository) {}

    public function listarInvestimentos()
    {
        return response()->json($this->repository->listarInvestimentos());
    }
}