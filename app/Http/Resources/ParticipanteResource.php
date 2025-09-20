<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ParticipanteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => Arr::get($this->resource, 'id'),
            'nome'              => Arr::get($this->resource, 'nome'),
            'tipo_participante' => Arr::get($this->resource, 'tipo_participante'),
        ];
    }
}
