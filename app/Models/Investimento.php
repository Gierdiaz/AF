<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Investimento extends Model
{
    protected $table = 'investimentos';

    protected $fillable = [
        'fundo_id',
        'nome',
        'valor'
    ];

    public function fundo(): BelongsTo
    {
        return $this->belongsTo(Fundo::class);
    }
}
