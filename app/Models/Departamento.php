<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $primaryKey = 'id_departamento';

    protected $fillable = ['nombre_departamento'];

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class, 'departamento_id', 'id_departamento');
    }
}
