<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investimento extends Model
{
    use HasFactory;

    protected $table = 'investimentos';

    protected $fillable = [
        'fundo_id',
        'nome',
        'tipo_investimento',
        'valor'
    ];

    public function fundo(): BelongsTo
    {
        return $this->belongsTo(Fundo::class);
    }

    public function transacoes(): HasMany
    {
        return $this->hasMany(Transacao::class);
    }
}
