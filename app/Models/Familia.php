<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Familia extends Model
{
    //
    use HasFactory;

    protected $table = 'familiares';
    protected $primaryKey = 'id_familiar';

    protected $fillable = [
        'usuario_id',
        'vive_con_usuario',
        'ciudad_id',
        'tipo_familiar'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id', 'id_ciudad');
    }
}
