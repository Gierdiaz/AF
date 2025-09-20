<?php

namespace App\Repositories;

use App\Enums\TipoDocumentoFundoEnum;
use App\Enums\TipoParticipanteEnum;
use App\Interfaces\ParticipanteRepositoryInterface;
use App\Models\Participante;

class ParticipanteRepository implements ParticipanteRepositoryInterface
{
    public function __construct(protected Participante $model) {}

    /** @inheritDoc */
    public function listarParticipantes(): array
    {
        return $this->model
            ->select('id', 'nome', 'tipo_participante')
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->toArray();
    }

    public function buscarParticipantesInvestidores(): array
    {
        return $this->model
            ->whereHas('participantes', function ($query) {
                $query->where('tipo_participante', TipoParticipanteEnum::INVESTIDOR->value);
            })
            ->get()
            ->toArray();
    }

    public function participantesPorFundo(string $idFundo): array
    {
        return $this->model
            ->find($idFundo)
            ?->participantes()
            ->select('participantes.id', 'participantes.nome', 'participantes.tipo_participante')
            ->get()
            ->toArray() ?? [];
    }

    public function participantesPorFundoGetRelated(string $idFundo): array
    {
        return $this->model
            ->participantes()
            ->getRelated()
            ->whereHas('fundos', function ($query) use ($idFundo) {
                $query->where('fundos.id', $idFundo);
            })
            ->get()
            ->toArray();
    }

    public function buscarParticipantePeloNome(?string $nome = null): array
    {
        return $this->model
            ->select('nome', 'tipo_participante')
            ->when($nome, function ($query, $nome) {
                $query->where('nome', 'LIKE', "%{$nome}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->toArray();
    }

    public function documentoAdministrador(string $id): array
    {
        return $this->model
            ->where('tipo_participante', TipoParticipanteEnum::ADMINISTRADOR)
            ->whereHas('fundos.documentosFundo', function ($query) {
                $query->where('tipo_documento', TipoDocumentoFundoEnum::LAMINA);
            })
            ->with(['fundos.documentosFundo' => function ($query) {
                $query->where('tipo_documento', TipoDocumentoFundoEnum::LAMINA);
            }])
            ->find($id)
            ->toArray();
    }
}
