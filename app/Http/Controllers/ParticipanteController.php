<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParticipanteAdministradorResource;
use App\Http\Resources\ParticipanteCollection;
use App\Interfaces\ParticipanteRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParticipanteController extends Controller
{
    public function __construct(protected ParticipanteRepositoryInterface $repository) {}

    public function listarParticipantes(Request $request)
    {
        $participantes = $this->repository->listarParticipantes();
        $resource = new ParticipanteCollection($participantes);
        return response()->json($resource->toArray($request), Response::HTTP_OK);
    }

    public function buscarParticipantesInvestidores()
    {
        return response()->json($this->repository->buscarParticipantesInvestidores());
    }

    public function participantesPorFundo(string $id)
    {
        return response()->json($this->repository->participantesPorFundo($id));
    }

    public function participantesPorFundoGetRelated(string $id)
    {
        return response()->json($this->repository->participantesPorFundoGetRelated($id));
    }

    public function buscarParticipantePeloNome(Request $request)
    {
        $nome = $request->query('nome', null);
        $participantes = $this->repository->buscarParticipantePeloNome($nome);
        return response()->json($participantes);
    }

    public function documentoAdministrador(string $id)
    {
        $participantes = $this->repository->documentoAdministrador($id);
        return new ParticipanteAdministradorResource($participantes);
    }
}
