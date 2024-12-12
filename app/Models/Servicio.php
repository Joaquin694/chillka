<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicio extends Model
{
    //
    use HasFactory;

    protected $table = 'servicios_basicos';
    protected $primaryKey = 'id_servicio';

    protected $fillable = ['hogar_id', 'agua', 'luz', 'saneamiento', 'internet'];

    public function hogar()
    {
        return $this->belongsTo(Hogar::class, 'hogar_id', 'id_hogar');
    }
}
