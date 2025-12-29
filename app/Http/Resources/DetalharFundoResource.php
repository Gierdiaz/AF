<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class DetalharFundoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'identificador do fundo' => Arr::get($this->resource, 'id'),
            'nome' => Arr::get($this->resource, 'nome'),
            'tipo do fundo' => Arr::get($this->resource, 'tipo_fundo'),
        ];
    }
}