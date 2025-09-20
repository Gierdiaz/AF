<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class FundoParticipanteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'identificador do fundo'            => Arr::get($this->resource, 'id'),
            'nome'          => Arr::get($this->resource, 'nome'),
            'tipo do fundo'    => Arr::get($this->resource, 'tipo_fundo'),
            'participante'  => $this->getParticipantes()
        ];
    }

    private function getParticipantes()
    {
        return Arr::map(Arr::get($this->resource, 'participantes', []), function ($participante) {
            return [
                'identificador do participante' => Arr::get($participante, 'id'),
                'nome' => Arr::get($participante, 'nome'),
                'tipo do participante' => Arr::get($participante, 'tipo_participante'),
                'pivô' => $this->getPivot($participante)
            ];
        });
    }

    private function getPivot(array $participante): array
    {
        return [
            'cotas' => Arr::get($participante, 'pivot.cotas')
        ];
    }

}
