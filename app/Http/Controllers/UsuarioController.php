<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public static function crearUsuario($hogarId, Request $request)
    {
        $usuario = Usuario::create([
            'hogar_id' => $hogarId,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'estado_civil' => $request->estado_civil,
        ]);

        return $usuario->id_usuario;
    }
}
