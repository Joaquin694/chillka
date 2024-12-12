<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\HogarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FamiliaController;
use App\Models\Ciudad;

class EncuestaController extends Controller
{
    public function mostrarEncuesta(Request $request)
    {
        $departamentos = DepartamentoController::listarDepartamentos();
        $ciudades = [];

        $departamentoSeleccionado = $request->input('departamento_id');
        if ($departamentoSeleccionado) {
            $ciudades = CiudadController::listarCiudadesPorDepartamento($departamentoSeleccionado);
        }

        return view('encuesta.encuesta', [
            'departamentos' => $departamentos,
            'ciudades' => $ciudades,
            'departamentoSeleccionado' => $departamentoSeleccionado,
        ]);
    }

    public function guardarEncuesta(Request $request)
    {
        $hogarId = HogarController::crearHogar($request);
        ServicioController::guardarServicios($hogarId, $request->input('servicios', []));

        $usuarioId = UsuarioController::crearUsuario($hogarId, $request);

        if (!$request->vive_con_familia && $request->tipo_familiar) {
            FamiliaController::crearFamiliar($usuarioId, $request);
        }

        return redirect()->route('encuesta.analisis', ['departamento_id' => $request->departamento_id]);
    }

    public function analizarEncuesta(Request $request)
    {
        return DepartamentoController::analizarCarenciaPorDepartamento($request->departamento_id);
    }

    public function obtenerCiudadesPorDepartamento($departamento_id)
{
    $ciudades = Ciudad::where('departamento_id', $departamento_id)->get(); // o lo que sea necesario para obtener las ciudades
    return response()->json($ciudades);
}

}
