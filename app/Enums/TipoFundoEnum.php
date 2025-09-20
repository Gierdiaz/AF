<?php

namespace App\Enums;

enum TipoFundoEnum: string
{
    case RENDA_FIXA = 'Renda Fixa';
    case RENDA_VARIAVEL = 'Renda Variável';
    case MULTIMERCADO = 'Multimercado';
    case CAMBIAL = 'Cambial';
}
