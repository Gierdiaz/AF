<?php

namespace App\Http\Controllers;

use App\Http\Resources\FundoParticipanteCollection;
use App\Http\Resources\FundoParticipanteResource;
use App\Interfaces\FundoRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FundoController extends Controller
{
    public function __construct(protected FundoRepositoryInterface $repository) {}

    public function listarFundos()
    {
        return response()->json($this->repository->listarFundos());
    }

    public function buscarFundosRendaFixa()
    {
        return response()->json($this->repository->buscarFundosRendaFixa());
    }

    public function buscarFundoParticipantes(Request $request)
    {
        $fundos = $this->repository->buscarFundoParticipantes();
        $resource = new FundoParticipanteCollection($fundos);
        return response()->json($resource->toArray($request), Response::HTTP_OK);
    }
}
