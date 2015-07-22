<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model {

    protected $table = 'direcciones';
    protected $primaryKey = 'id_direccion';
    public $timestamps = false;

    public function parqueaderos() {
        return $this->hasMany('App\Parqueadero');
    }

    public function ciudades() {
        return $this->belongsTo('App\Ciudad', 'id_ciudad');
    }
    
    public function paises() {
        return $this->belongsTo('App\Pais', 'id_pais');
    }

}
