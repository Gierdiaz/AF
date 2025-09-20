<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class FundoParticipanteCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'fundos'       => FundoParticipanteResource::collection($this->collection),
            'current_page' => Arr::get($this->resource, 'current_page'),
            'per_page'     => Arr::get($this->resource, 'per_page'),
            'last_page'    => Arr::get($this->resource, 'last_page'),
            'total'        => Arr::get($this->resource, 'total'),
        ];
    }
}
