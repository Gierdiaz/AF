<?php

namespace App\DTOs;

use Illuminate\Support\Arr;

class FundoDTO
{
    public function __construct(
        public readonly string $nome,
        public readonly string $tipo_fundo,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            nome: Arr::get($data, 'nome'),
            tipo_fundo: Arr::get($data, 'tipo_fundo'),
        );
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'tipo_fundo' => $this->tipo_fundo
        ];
    }
}