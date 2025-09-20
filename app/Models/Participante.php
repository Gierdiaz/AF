<?php

namespace App\Models;

use App\Enums\TipoParticipanteEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Hashing\HashManager;
use TipoDocumentoFundoEnum;

class Participante extends Model
{
    use HasFactory;

    protected $table = 'participantes';

    protected $fillable = [
        'nome',
        'tipo_participante'
    ];

    public function fundos()
    {
        return $this->belongsToMany(Fundo::class, 'fundo_participante')
            ->withPivot('cotas')
            ->withTimestamps();
    }

    // OneToOne
    public function documento() {
        return $this->hasOne(Documento::class);
    }

    // Polymorphic
    public function endereco() {
        return $this->morphOne(Endereco::class, 'addressable');
    }

    public function comentarios() {
        return $this->morphMany(Comentario::class, 'commentable');
    }

    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
