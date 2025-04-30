<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['Mantenimientos' => Mantenimiento::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mantenimiento = new Mantenimiento;
        $mantenimiento->equipo_id = $request->equipo_id;
        $mantenimiento->descripcion = $request->descripcion;
        $mantenimiento->fecha = $request->fecha;
        $mantenimiento->tecnico = $request->tecnico;
        $mantenimiento->save();

        return response()->json(['mensaje' => 'Mantenimiento registrado exitosamente'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([Mantenimiento::findOrFail($id)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update($request->all());

        return response()->json(['mensaje' => 'Mantenimiento actualizado correctamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Mantenimiento::destroy($id);

        return response()->json(['mensaje' => 'Mantenimiento eliminado correctamente']);
    }
}