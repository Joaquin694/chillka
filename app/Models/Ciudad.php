<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ciudad extends Model
{
    //
    use HasFactory;

    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';

    protected $fillable = ['departamento_id', 'nombre_ciudad'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id_departamento');
    }

    public function hogares()
    {
        return $this->hasMany(Hogar::class, 'ciudad_id', 'id_ciudad');
    }

    public function familiares()
    {
        return $this->hasMany(Familia::class, 'ciudad_id', 'id_ciudad');
    }
}
