<?php

namespace App\Enums;

enum TipoFundoEnum: string
{
    case RENDA_FIXA = 'Renda Fixa';          // Investe em títulos públicos e privados de baixo risco
    case RENDA_VARIAVEL = 'Renda Variável';  // Ações e ativos ligados à bolsa
    case MULTIMERCADO = 'Multimercado';      // Combina renda fixa + variável
    case CAMBIAL = 'Cambial';                // Investe em moedas estrangeiras
    case IMOBILIARIO = 'Imobiliário';        // Foca em imóveis e FIIs
    case PREVIDENCIA = 'Previdência';        // Fundos de aposentadoria
    case OFFSHORE = 'Offshore';              // Fundos com ativos no exterior
}
