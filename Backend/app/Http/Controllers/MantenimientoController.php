<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['mantenimientos' => Mantenimiento::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $mantenimiento = Mantenimiento::create($request->all());
        return response()->json(['mensaje' => 'Mantenimiento registrado exitosamente', 'mantenimiento' => $mantenimiento], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return response()->json(['mantenimiento' => Mantenimiento::findOrFail($id)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update($request->all());
        return response()->json(['mensaje' => 'Mantenimiento actualizado correctamente', 'mantenimiento' => $mantenimiento], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Mantenimiento::destroy($id);
        return response()->json(['mensaje' => 'Mantenimiento eliminado correctamente'], 200);
    }
}