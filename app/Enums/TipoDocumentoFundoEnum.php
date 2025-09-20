<?php

namespace App\Enums;

enum TipoDocumentoFundoEnum: string
{
    case REGULAMENTO = 'Regulamento';
    case LAMINA = 'Lâmina de Informações Essencias';
    case FORMULARIO = 'Formulário de Informações Complementares';
    case DEMONSTRATIVOS = 'Demonstrativos Contábeis';
}