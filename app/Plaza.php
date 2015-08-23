<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parqueadero;

class Plaza extends Model {

    protected $table = "plazas";
    protected $primaryKey = "id_plaza";
    protected $fillable = ["id_parqueadero", "numero", "estado"];
    public $timestamps = false;

    public function parqueadero() {
        return $this->belongsTo('App\Parqueadero', 'id_parqueadero');
    }

}
