<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;

class CiudadController extends Controller
{
    public static function listarCiudadesPorDepartamento($departamentoId)
    {
        return Ciudad::where('departamento_id', $departamentoId)->get();
    }
}
