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
        $this->decimal('por_hora',6,2);
        $this->decimal('semanal',6,2);
        $this->decimal('mensual',6,2);
        $this->decimal('anual',6,2);
        return $this->belongsToMany('App\Parqueadero', 'tarifa_horarios', 'id_tarifa');
    }

}
