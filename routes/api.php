<?php

use App\Http\Controllers\FundoController;
use App\Http\Controllers\InvestimentoController;
use App\Http\Controllers\ParticipanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rotas de Fundos
Route::prefix('fundos')->group(function () {
    Route::get('listar', [FundoController::class, 'listarFundos']);
    Route::get('buscar-renda-fixa', [FundoController::class, 'buscarFundosRendaFixa']);
    Route::get('com-participantes', [FundoController::class, 'buscarFundoParticipantes']);
    Route::post('criar-fundo', [FundoController::class, 'criarFundo']);
    Route::get('{fundoId}/detalhar', [FundoController::class, 'buscarFundo']);
});

// Rotas de Participanteshp
Route::prefix('participantes')->group(function () {
    Route::get('listar', [ParticipanteController::class, 'listarParticipantes']);
    Route::get('testar-arrays', [ParticipanteController::class, 'testarArraysHelpers']);
    Route::get('investidores', [ParticipanteController::class, 'buscarParticipantesInvestidores']);
    Route::get('buscar', [ParticipanteController::class, 'buscarParticipantePeloNome']); // ?nome=All
    Route::get('participantes-investimentos/{participante_id}', [ParticipanteController::class, 'obterParticipantesEseusInvestimentos']);
    Route::get('{id}/documento-administraddor', [ParticipanteController::class, 'documentoAdministrador']);
    Route::get('{id}/por-fundo', [ParticipanteController::class, 'participantesPorFundo']);
    Route::get('{id}/por-fundo-related', [ParticipanteController::class, 'participantesPorFundoGetRelated']);

});

Route::prefix('investimentos')->group(function () {
    Route::get('listar-investimentos', [InvestimentoController::class, 'listarInvestimentos']);
});