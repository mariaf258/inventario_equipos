<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EquiposController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\HistoricoController;

//   Route::get('/index', function(){
//         // [EquiposController::class, 'index']
//         return "hola desde el controlador";
//     }); 
Route::prefix('equipos')->group(function () {
    Route::get('index',[EquiposController::class, 'index']); 
    Route::post('/store', [EquiposController::class, 'store']); 
    Route::get('/show/{id}', [EquiposController::class, 'show']);
    Route::put('/update/{id}', [EquiposController::class, 'update']);
    Route::delete('/destroy/{id}', [EquiposController::class, 'destroy']);
});

Route::prefix('ubicaciones')->group(function () {
   Route::get('/index', [UbicacionController::class, 'index']);
    Route::post('/store', [UbicacionController::class, 'store']);
    Route::get('/show/{id}', [UbicacionController::class, 'show']);
    Route::put('/update/{id}', [UbicacionController::class, 'update']);
    Route::delete('/destroy/{id}', [UbicacionController::class, 'destroy']); 
});

Route::prefix('mantenimientos')->group(function () {
    Route::get('/index', [MantenimientoController::class, 'index']);
    Route::post('/store', [MantenimientoController::class, 'store']);
    Route::get('/show/{id}', [MantenimientoController::class, 'show']);
    Route::put('/update/{id}', [MantenimientoController::class, 'update']);
    Route::delete('/destroy/{id}', [MantenimientoController::class, 'destroy']);
});

Route::prefix('asignaciones')->group(function () {
    Route::get('/index', [AsignacionController::class, 'index']);
    Route::post('/store', [AsignacionController::class, 'store']);
    Route::get('/show/{id}', [AsignacionController::class, 'show']);
    Route::put('/update/{id}', [AsignacionController::class, 'update']);
    Route::delete('/destroy/{id}', [AsignacionController::class, 'destroy']);
});

Route::prefix('historicos')->group(function () {
    Route::get('/index', [HistoricoController::class, 'index']);
    Route::post('/store', [HistoricoController::class, 'store']);
    Route::get('/show/{id}', [HistoricoController::class, 'show']);
    Route::put('/update/{id}', [HistoricoController::class, 'update']);
    Route::delete('/destroy/{id}', [HistoricoController::class, 'destroy']);
});