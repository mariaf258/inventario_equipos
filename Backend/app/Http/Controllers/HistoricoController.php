<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index()
    {
        return response()->json(['historicos' => Historico::all()], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'accion' => 'required|string',
            'fecha' => 'nullable|date',
        ]);

        $historico = Historico::create($validated);

        return response()->json([
            'mensaje' => 'Registro histórico guardado exitosamente',
            'historico' => $historico
        ], 201);
    }

    public function show(string $id)
    {
        $historico = Historico::findOrFail($id);

        return response()->json(['historico' => $historico], 200);
    }

    public function update(Request $request, string $id)
    {
        $historico = Historico::findOrFail($id);

        $validated = $request->validate([
            'equipo_id' => 'sometimes|exists:equipos,id',
            'accion' => 'sometimes|string',
            'fecha' => 'nullable|date',
        ]);

        $historico->update($validated);

        return response()->json([
            'mensaje' => 'Registro histórico actualizado correctamente',
            'historico' => $historico
        ], 200);
    }

    public function destroy(string $id)
    {
        $historico = Historico::findOrFail($id);
        $historico->delete();

        return response()->json([
            'mensaje' => 'Registro histórico eliminado correctamente'
        ], 200);
    }
}