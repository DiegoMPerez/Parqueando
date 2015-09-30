<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa_Horario extends Model {

    protected $table = 'tarifa_horario';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function parqueaderos() {
        return $this->belongsTo('App\Parqueadero', 'id_parqueadero');
    }
    
    public function horarios() {
        return $this->belongsTo('App\Horario', 'id_horario');
    }
    
    public function precios() {
        return $this->belongsTo('App\Precio', 'id_tarifa');
    }

}
