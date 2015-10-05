<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model {

    protected $table = 'horarios';
    protected $primaryKey = 'id_horario';

    public $timestamps = false;
    
    public function tarifa_horarios() {
        return $this->hasMany('App\Tarifa_Horario');
    }
    
    public function parqueaderos() {
        return $this->belongsToMany('App\Parqueadero', 'Tarifa_Horario', 'id_parqueadero', 'id_horario');
    }

}
