<?php

namespace App\Enums;

enum TipoInvestimentoEnum: string
{
    case ACAO = 'Ação';                            // Ex: PETR4, VALE3
    case CDB = 'CDB';                              // Certificado de Depósito Bancário
    case LCI = 'LCI';                              // Letra de Crédito Imobiliário
    case LCA = 'LCA';                              // Letra de Crédito do Agronegócio
    case TESOURO_DIRETO = 'Tesouro Direto';        // Títulos públicos federais
    case DEBENTURE = 'Debênture';                  // Título de dívida de empresas
    case FII = 'Fundo Imobiliário';                // Cotas de fundos imobiliários
    case ETF = 'ETF';                              // Fundos de índice
    case CRIPTOMOEDA = 'Criptomoeda';              // Ex: Bitcoin, Ethereum
    case CAMBIO = 'Câmbio';                        // Dólar, Euro, etc.
}
