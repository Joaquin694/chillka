<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hogar extends Model
{
    //
    use HasFactory;

    protected $table = 'hogares';
    protected $primaryKey = 'id_hogar';

    protected $fillable = ['ciudad_id', 'direccion'];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id', 'id_ciudad');
    }

    public function serviciosBasicos()
    {
        return $this->hasOne(Servicio::class, 'hogar_id', 'id_hogar');
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'hogar_id', 'id_hogar');
    }
}
