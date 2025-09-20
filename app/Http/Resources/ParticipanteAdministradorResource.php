<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ParticipanteAdministradorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'               => Arr::get($this->resource, 'id'),
            'nome'             => Arr::get($this->resource, 'nome'),
            'tipo_participante'=> Arr::get($this->resource, 'tipo_participante'),
            'fundos'           => $this->getFundos(),
        ];
    }

    private function getFundos()
    {
        return Arr::map(Arr::get($this->resource, 'fundos', []), function ($fundo) {
            return [
                'id'        => Arr::get($fundo, 'id'),
                'nome'      => Arr::get($fundo, 'nome'),
                'tipo_fundo'=> Arr::get($fundo, 'tipo_fundo'),
                'documentos'=> $this->getDocumentos($fundo),
            ];
        });
    }

    private function getDocumentos($fundo)
    {
        return Arr::map(Arr::get($fundo, 'documentos_fundo', []), function ($doc) {
            return [
                'id'             => Arr::get($doc, 'id'),
                'tipo_documento' => Arr::get($doc, 'tipo_documento'),
                'data_publicada' => Arr::get($doc, 'data_publicada'),
            ];
        });
    }
}
