<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ArrayHelperService
{
    /**
     * Recebe o array de participantes e demonstra o uso de helpers Arr
     */
    public function testarHelper(array $participantes): array
    {
        // Pegar um valor específico dentro do array
        $primeiroNome = Arr::get($participantes, 'data.0.nome');

        // Definir um novo valor
        Arr::set($participantes, 'data.0.nome', 'Velma Adams Alterada pelo set');

        // Verificar se existe um chave dentro do array
        $existeChave = Arr::has($participantes, 'data.1.tipo_participante');
        
        // Extrai apenas a coluna específica do array
        $tipoDoParticipante = Arr::pluck(Arr::get($participantes, 'data'), 'tipo_participante');

        // Garantir qque algo é array
        $garantirArray = Arr::wrap(Arr::pluck(Arr::get($participantes, 'data'), 'tipo_participante'));

        // Filtrar e ordernar
        $somenteNomeComV = Arr::where(Arr::get($participantes, 'data'), function ($participantes) {
            return Str::startsWith(Arr::get($participantes, 'nome'), 'V');
        });

        $tipoResource = Arr::map(Arr::get($participantes, 'data'), function ($participantes) {
            return [
                'id' => Arr::get($participantes, 'id'),
                'nome' => Arr::get($participantes, 'nome'),
                'tipo_participante' => Arr::get($participantes, 'tipo_participante'),
            ];
        });

        // Trazendo os primeiros registros setados
        $trazendoOsPrimeirosRegistros = Arr::take(Arr::get($participantes, 'data'), 3);
      
        $somenteNome = Arr::only(Arr::get($participantes, 'data.0'), Arr::wrap('nome'));

        $listandoSomenteNome = Arr::map(Arr::get($participantes, 'data'), function ($item) {
            return Arr::only($item, Arr::wrap('nome'));
        });

        $semNome = Arr::except($participantes, 'nome');

        $abc = Arr::wrap(
            ['a' => 1],
            ['b' => 2],
            ['c' => 3]
        );

        $untandoABC = Arr::collapse($abc);

        $dados = [
            'b' => 2,
            'l' => 1,
            'e' => 4,
            's' => 3,
            'a' => 5
        ];

        Arr::sort($dados);
        
        return [
            'primeiro_nome' => $primeiroNome,
            'adicionou_nome_alterado_com_set' => Arr::get($participantes, 'data.0.nome'),
            'existe_chave' => $existeChave,
            'tipo_do_participante' => $tipoDoParticipante,
            'garantir_array' => $garantirArray,
            'somente_nome_com_a' => $somenteNomeComV,
            'tipo_resource' => $tipoResource,
            'trazendo_os_primeiros_registros' => $trazendoOsPrimeirosRegistros,
            'somente_nome' => $somenteNome,
            'listando_somente_nome' => $listandoSomenteNome,
            'sem_nome' => $semNome,
            'abc' => $abc,
            'untando_abc' => $untandoABC,
            'dados' => $dados
        ];
    }
}