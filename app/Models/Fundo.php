<?php

namespace App\Models;

use App\Enums\TipoParticipanteEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    /** One To Many - Fundo possui vários documentos oficiais */
    public function documentosFundo(): HasMany
    {
        return $this->hasMany(DocumentoFundo::class);
    }

    /** One To Many (Polymorphic) - Fundo pode ter vários Comentários */
    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'commentable');
    }

    /** One To One (Polymorphic) - Fundo pode ter um Endereço */
    public function endereco()
    {
        return $this->morphOne(Endereco::class, 'addressable');
    }

    /** Many To Many (Polymorphic) - Fundo pode ter várias Tags */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
