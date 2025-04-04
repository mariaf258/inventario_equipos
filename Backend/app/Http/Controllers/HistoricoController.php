<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return response()->json(['historicos' => Historico::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $historico = Historico::create($request->all());
        return response()->json(['mensaje' => 'Registro histórico guardado exitosamente', 'historico' => $historico], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['historico' => Historico::findOrFail($id)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $historico = Historico::findOrFail($id);
        $historico->update($request->all());
        return response()->json(['mensaje' => 'Registro histórico actualizado correctamente', 'historico' => $historico], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Historico::destroy($id);
        return response()->json(['mensaje' => 'Registro histórico eliminado correctamente'], 200);
    }
}