<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiagnosticoRespuesta extends Model
{
    protected $table = 'diagnostico_respuestas';

    protected $fillable = [
        'user_id',
        'pregunta_numero',
        'opcion_elegida',
        'es_correcta',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
