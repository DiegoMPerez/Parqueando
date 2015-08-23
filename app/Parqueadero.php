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


}
