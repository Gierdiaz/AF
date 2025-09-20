<?php

namespace App\Interfaces;

interface ParticipanteRepositoryInterface
{
    public function listarParticipantes(): array;

    public function buscarParticipantesInvestidores(): array;

    public function participantesPorFundo(string $idFundo): array;

    public function participantesPorFundoGetRelated(string $idFundo): array;

    public function buscarParticipantePeloNome(?string $nome = null): array;

    public function documentoAdministrador(string $id): array;
}
