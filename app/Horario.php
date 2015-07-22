<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model {

    protected $table = 'horarios';
    protected $primaryKey = 'id_horario';

    public function parqueaderos() {
        return $this->hasMany('App\Parqueadero');
    }

}
