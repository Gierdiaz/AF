<?php

namespace App\Enums;

enum TipoParticipanteEnum: string
{
    // Investidor
    case INVESTIDOR = 'Investidor';

    // Prestadores de serviço principais
    case ADMINISTRADOR = 'Administrador';
    case GESTOR = 'Gestor';
    case CUSTODIANTE = 'Custodiante';
    case DISTRIBUIDOR = 'Distribuidor';
    case AUDITOR = 'Auditor';

    // OUtros possíveis
    case CONTROLADRO_RISCO = 'Controlador de Risco';
    case ESCRITURADOR = 'Escriturador';
    case ASSESSOR = 'Assessor';

}