<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return response()->json(['Equipos' => Equipo::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $equipo = new Equipo;
        $equipo->serial = $request->serial;
        $equipo->ip = $request->ip;
        $equipo->tipo = $request->tipo;
        $equipo->marca = $request->marca;
        $equipo->modelo = $request->modelo;
        $equipo->estado = $request->estado;
        $equipo->ubicacion_id = $request->ubicacion_id;
        $equipo->save();
        return response()->json(['mensaje'=>'Equipo Creado Con Exito'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([Equipo::findOrFail($id)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->update($request->all());
        return response()->json(['Mensaje' => 'Equipo Actualizado Con Exito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Equipo::destroy($id);
        return response()->json(['Mensaje' => 'Equipo Eliminado']);
    }
}