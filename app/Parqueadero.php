<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class Parqueadero extends Model {

    protected $table = 'parqueaderos';
    protected $primaryKey = 'id_parqueadero';
    protected $fillable = ['id_usuario','nombre', 'numero_plazas', 'telefono', 'ubicacion_geografica', 'id_direccion', 'estado'];
    public $timestamps = false;
    
    public function direcciones() {
        return $this->belongsTo('App\Direccion', 'id_direccion');
    }
    
    public function plazas() {
        return $this->hasMany('App\Plaza', 'id_parqueadero');
    }
    
    public function usuarios() {
        return $this->belongsTo('App\User', 'id');
    }
    
    public function tarifa_horarios() {
        return $this->hasMany('App\Tarifa_Horario', 'id_tarifa');
    }
    
    public function tarifas() {
        return $this->belongsToMany('App\Precio', 'tarifa_horario', 'id_parqueadero', 'id_tarifa');
    }
    
    public function horarios() {
        return $this->belongsToMany('App\Horario', 'tarifa_horario', 'id_parqueadero', 'id_horario');
    }


}
