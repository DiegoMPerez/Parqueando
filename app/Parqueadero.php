<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Parqueadero extends Model {

    protected $table = 'parqueaderos';
    protected $primaryKey = 'id_parqueadero';
    protected $fillable = ['nombre', 'numero_plazas', 'telefono', 'ubicacion_geografica', 'id_direccion', 'estado'];
    public $timestamps = false;

    public function direcciones() {
        return $this->belongsTo('App\Direccion', 'id_direccion');
    }


}
