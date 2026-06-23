<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $alumnos = User::with('respuestasDiagnostico')->get()->map(function ($alumno) {
            $totalRespondidas = $alumno->respuestasDiagnostico->count();
            $correctas = $alumno->respuestasDiagnostico->where('es_correcta', true)->count();

            return [
                'id' => $alumno->id,
                'name' => $alumno->name,
                'email' => $alumno->email,
                'progreso' => $totalRespondidas . ' / 10',
                'nota' => $totalRespondidas > 0 ? $correctas : '-',
                'respuestas' => $alumno->respuestasDiagnostico->pluck('es_correcta', 'pregunta_numero')->toArray()
            ];
        });

        return view('admin.dashboard', compact('alumnos'));
    }
}
