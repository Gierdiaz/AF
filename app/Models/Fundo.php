<?php

namespace App\Models;

use App\Enums\TipoParticipanteEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Fundo extends Model
{
    use HasFactory;

    protected $table = 'fundos';

    protected $fillable = [
        'nome',
        'tipo_fundo'
    ];

    /** One To One - Fundo tem um Administrador */
    public function administrador(): BelongsToMany
    {
        return $this->BelongsToMany(Participante::class, 'fundo_participante')
            ->wherePivotNull('cotas')
            ->where('tipo_participante', TipoParticipanteEnum::ADMINISTRADOR->value);
    }

    /** One To One - Fundo tem um Gestor */
    public function gestor(): BelongsToMany
    {
        return $this->belongsToMany(Participante::class, 'fundo_participante')
            ->wherePivotNull('cotas')
            ->where('tipo_participante', TipoParticipanteEnum::GESTOR->value);
    }

    /** Many To Many pivot - Participantes em geral */
    public function participantes()
    {
        return $this->belongsToMany(Participante::class, 'fundo_participante')
            ->withPivot('cotas');
    }

    /** One To Many - Fundo tem muitos Investimentos */
    public function investimentos(): HasMany
    {
        return $this->hasMany(Investimento::class);
    }

    public function transacoes(): HasManyThrough
    {
        return $this->hasManyThrough(
            Transacao::class,     // modelo final
            Investimento::class,  // modelo intermediário
            'fundo_id',           // FK do Investimento apontando para Fundo
            'investimento_id',    // FK da Transacao apontando para Investimento
            'id',                 // PK do Fundo
            'id'                  // PK do Investimento
        );
    }
}


