<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transacao extends Model
{
    use HasFactory;

    protected $table = 'transacoes';

    protected $fillable = [
        'investimento_id',
        'valor',
        'tipo',
    ];

    public function investimento(): BelongsTo
    {
        return $this->belongsTo(Investimento::class);
    }
}
