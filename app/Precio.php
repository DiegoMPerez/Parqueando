<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model {

    protected $table = 'precios';
    protected $primaryKey = 'id_tarifa';

    public $timestamps = false;
    
    public function parqueaderos() {
        return $this->hasMany('App\Parqueadero');
    }

}
