<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

class ServicioController extends Controller
{
    public static function guardarServicios($hogarId, array $servicios)
    {
        $serviciosData = [
            'hogar_id' => $hogarId,
            'agua' => in_array('agua', $servicios),
            'luz' => in_array('luz', $servicios),
            'saneamiento' => in_array('saneamiento', $servicios),
            'internet' => in_array('internet', $servicios),
        ];

        Servicio::create($serviciosData);
    }
}
