<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['ubicaciones' => Ubicacion::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ubicacion = Ubicacion::create($request->all());
        return response()->json(['mensaje' => 'Ubicación creada exitosamente', 'ubicacion' => $ubicacion], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['ubicacion' => Ubicacion::findOrFail($id)], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($request->all());
        return response()->json(['mensaje' => 'Ubicación actualizada correctamente', 'ubicacion' => $ubicacion], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ubicacion::destroy($id);
        return response()->json(['mensaje' => 'Ubicación eliminada correctamente'], 200);
    }
}