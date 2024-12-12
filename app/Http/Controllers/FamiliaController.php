<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familia;

class FamiliaController extends Controller
{
    public static function crearFamiliar($usuarioId, Request $request)
    {
        Familia::create([
            'id_usuario' => $usuarioId,
            'vive_con_usuario' => false,
            'tipo_familiar' => $request->tipo_familiar,
            'ciudad_id' => $request->ciudad_familiar,
        ]);
    }
}
