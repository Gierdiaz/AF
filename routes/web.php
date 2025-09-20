<?php

use App\Http\Controllers\FundoController;
use App\Http\Controllers\ParticipanteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de Fundos
Route::prefix('fundos')->group(function () {
    Route::get('listar', [FundoController::class, 'listarFundos']);
    Route::get('buscar-renda-fixa', [FundoController::class, 'buscarFundosRendaFixa']);
    Route::get('com-participantes', [FundoController::class, 'buscarFundoParticipantes']);
});

// Rotas de Participantes
Route::prefix('participantes')->group(function () {
    Route::get('listar', [ParticipanteController::class, 'listarParticipantes']);
    Route::get('investidores', [ParticipanteController::class, 'buscarParticipantesInvestidores']);
    Route::get('{id}/documento-administraddor', [ParticipanteController::class, 'documentoAdministrador']);
    Route::get('{id}/por-fundo', [ParticipanteController::class, 'participantesPorFundo']);
    Route::get('{id}/por-fundo-related', [ParticipanteController::class, 'participantesPorFundoGetRelated']);
    Route::get('buscar', [ParticipanteController::class, 'buscarParticipantePeloNome']); // ?nome=All
});
