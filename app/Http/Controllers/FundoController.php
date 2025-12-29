<?php

namespace App\Http\Controllers;

use App\Actions\CriarFundoAction;
use App\DTOs\FundoDTO;
use App\Http\Requests\StoreFundoRequest;
use App\Http\Resources\DetalharFundoResource;
use App\Http\Resources\FundoParticipanteCollection;
use App\Http\Resources\FundoResource;
use App\Interfaces\FundoRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class FundoController extends Controller
{
    public function __construct(protected FundoRepositoryInterface $repository) {}

    public function listarFundos()
    { 
        try {
            $fundo = $this->repository->listarFundos();
            
            $fundosSimplificados = Arr::pluck($fundo, 'nome', 'id');
            return response([
                'resumo' => $fundosSimplificados,
                'data' => FundoResource::collection($fundo),
                'message' => 'Fundos listados com sucesso',
                'status' => Response::HTTP_OK
            ]);
        } catch (\Throwable $th) {
            dump($th);
        }
    }

    public function buscarFundo(string $fundoId)
    {
        try {
            $fundo = $this->repository->obterFundoById($fundoId);

            if (!Arr::has($fundo, 'tipo_fundo')) {
                Arr::set($fundo, 'tipo_fundo', 'Não informado');
            }

            $fundo = Arr::only($fundo, ['nome', 'tipo_fundo']);

            return response([
                'data' => new DetalharFundoResource($fundo),
                'message' => 'Fundo encontrado com sucesso',
                'status' => Response::HTTP_OK
            ]);
        } catch (\Throwable $th) {
            return response([
                'data' => null,
                'message' => 'Fundo não encontrado' . $th->getMessage(),
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
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

    public function criarFundo(StoreFundoRequest $request, CriarFundoAction $action)
    {
        $dto = FundoDTO::fromRequest($request->validated());
        $fundo = $action->execute($dto);
        return response()->json($fundo, Response::HTTP_CREATED);
    }
}
