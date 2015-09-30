<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model {

    protected $table = 'precios';
    protected $primaryKey = 'id_tarifa';

    public $timestamps = false;
    
    public function tarifa_horarios() {
        return $this->hasMany('App\Tarifa_Horario', 'id_tarifa');
    }
    
    public function parqueaderos(){
        return $this->belongsToMany('App\Parqueadero', 'tarifa_horarios', 'id_tarifa');
    }

}
