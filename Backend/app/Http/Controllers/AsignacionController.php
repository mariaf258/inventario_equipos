<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        return response()->json(['asignaciones' => Asignacion::with(['user', 'equipo'])->get()], 200);
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'equipo_id' => 'required|exists:equipos,id',
        'fecha_asignacion' => 'required|date|not_in:0000-00-00',
        'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_asignacion',
    ]);

    $asignacion = Asignacion::create($request->all());

    return response()->json([
        'mensaje' => 'Asignación creada con éxito',
        'asignacion' => $asignacion
    ], 201);
}

    public function show(string $id)
    {
        $asignacion = Asignacion::with(['user', 'equipo'])->findOrFail($id);
        return response()->json(['asignacion' => $asignacion], 200);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'equipo_id' => 'sometimes|exists:equipos,id',
            'fecha_asignacion' => 'sometimes|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_asignacion',
        ]);

        $asignacion = Asignacion::findOrFail($id);
        $asignacion->update($request->all());

        return response()->json([
            'mensaje' => 'Asignación actualizada correctamente',
            'asignacion' => $asignacion
        ], 200);
    }

    public function destroy(string $id)
    {
        Asignacion::destroy($id);
        return response()->json(['mensaje' => 'Asignación eliminada correctamente'], 200);
    }
}