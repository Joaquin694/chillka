<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    //
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'edad',
        'hogar_id',
        'nombre',
        'apellido',
        'numero_eni',
        'sexo',
        'estado_civil'
    ];

    public function hogar()
    {
        return $this->belongsTo(Hogar::class, 'hogar_id', 'id_hogar');
    }

    public function familiares()
    {
        return $this->hasMany(Familia::class, 'usuario_id', 'id_usuario');
    }

    public function datosAdicionales()
    {
        return $this->hasMany(Adicional::class, 'usuario_id', 'id_usuario');
    }
}
