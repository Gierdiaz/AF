<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentoFundo extends Model
{
    use HasFactory;

    protected $table = 'documento_fundos';

    protected $fillable = [
        'fundo_id',
        'tipo_documento',
        'data_publicada'
    ];

    /** Belongs To - Documento pertence a um Fundo */
    public function fundo(): BelongsTo
    {
        return $this->belongsTo(Fundo::class);
    }
}
