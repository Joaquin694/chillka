<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    public static function listarDepartamentos()
    {
        return Departamento::all();
    }

    public static function analizarCarenciaPorDepartamento($departamentoId)
    {
        // Ruta al archivo JSON
        $jsonPath = public_path('json/carencia_medica.json'); // Ajusta si es necesario
        if (!file_exists($jsonPath)) {
            return response()->json(['message' => 'Archivo de datos no encontrado.'], 500);
        }

        // Cargar los datos del archivo JSON
        $data = json_decode(file_get_contents($jsonPath), true);

        // Obtener todos los departamentos
        $departamentos = Departamento::all();

        // Obtener el nombre del departamento seleccionado
        $departamento = Departamento::find($departamentoId);
        $departamentoNombre = $departamento->nombre_departamento ?? null;

        // Si el departamento seleccionado tiene datos en el JSON
        $carenciaDepartamento = $departamentoNombre && isset($data['carencia_medica']['departamentos'][$departamentoNombre])
            ? $data['carencia_medica']['departamentos'][$departamentoNombre]
            : null;

        // Obtener todos los porcentajes de carencia médica
        $carencias = $data['carencia_medica']['departamentos'];

        // Retornar la vista con los datos
        return view('encuesta.analisis', [
            'departamentos' => $departamentos,
            'carencias' => $carencias,
            'departamentoSeleccionado' => $departamentoNombre,
            'carenciaDepartamento' => $carenciaDepartamento,
            'nacional' => $data['carencia_medica']['grupos_vulnerables']['Nacional']
        ]);
    }
}


