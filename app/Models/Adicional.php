<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adicional extends Model
{
    //
    use HasFactory;

    protected $table = 'datos_adicionales';
    protected $primaryKey = 'id_dato';

    protected $fillable = ['usuario_id', 'clave', 'valor'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }
}
