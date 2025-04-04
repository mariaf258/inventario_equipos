<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['asignaciones' => Asignacion::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asignacion = Asignacion::create($request->all());
        return response()->json(['mensaje' => 'Asignación creada exitosamente', 'asignacion' => $asignacion], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return response()->json(['asignacion' => Asignacion::findOrFail($id)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $asignacion = Asignacion::findOrFail($id);
        $asignacion->update($request->all());
        return response()->json(['mensaje' => 'Asignación actualizada correctamente', 'asignacion' => $asignacion], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Asignacion::destroy($id);
        return response()->json(['mensaje' => 'Asignación eliminada correctamente'], 200);
    }
}