<?php

namespace App\Http\Controllers;

use App\Models\DiagnosticoRespuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosticoController extends Controller
{
    public function index()
    {
        $respuestasAlumno = DiagnosticoRespuesta::where('user_id', Auth::id())
            ->pluck('es_correcta', 'pregunta_numero')
            ->toArray();

        return view('panel.diagnostico', compact('respuestasAlumno'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'pregunta_numero' => 'required|integer',
            'opcion_elegida' => 'required|integer|between:0,3',
        ]);

        $solucionario = [
            1 => 1, 2 => 3, 3 => 1, 4 => 1, 5 => 0,
            6 => 2, 7 => 2, 8 => 0, 9 => 1, 10 => 1
        ];

        $pregunta = $request->pregunta_numero;
        $correcta = isset($solucionario[$pregunta]) && ($request->opcion_elegida == $solucionario[$pregunta]);

        $respuesta = DiagnosticoRespuesta::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'pregunta_numero' => $pregunta,
            ],
            [
                'opcion_elegida' => $request->opcion_elegida,
                'es_correcta' => $correcta,
            ]
        );

        return response()->json([
            'success' => true,
            'es_correcta' => $correcta,
            'mensaje' => $correcta ? '¡Correcto!' : 'Respuesta incorrecta.'
        ]);
    }
}
