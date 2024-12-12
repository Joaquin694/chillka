<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hogar;

class HogarController extends Controller
{
    public static function crearHogar(Request $request)
    {
        $hogar = Hogar::create([
            'ciudad_id' => $request->ciudad_id,
            'direccion' => $request->direccion,
        ]);

        return $hogar->id_hogar;
    }
}
