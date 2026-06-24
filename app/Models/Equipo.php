<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'marca',
        'modelo',
        'ip',
        'ubicacion',
        'estado',
        'archivo',
    ];
}