<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncuestaController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/encuesta', [EncuestaController::class, 'mostrarEncuesta'])->name('encuesta.mostrar');
Route::post('/encuesta', [EncuestaController::class, 'guardarEncuesta'])->name('encuesta.guardar');
Route::get('/analizar', [EncuestaController::class, 'analizarEncuesta'])->name('encuesta.analisis');


Route::get('/ciudades/{departamento_id}', action: [EncuestaController::class, 'obtenerCiudadesPorDepartamento']);
