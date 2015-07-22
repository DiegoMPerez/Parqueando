<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Parqueadero extends Model {

	protected $table = 'parqueaderos';
        protected $primaryKey = 'id_parqueadero';
        
        public $timestamps = false;
        
         public function horarios() {
         return $this->belongsTo('App\Horario', 'id_horario');
         }
         public function direcciones() {
         return $this->belongsTo('App\Direccion', 'id_direccion');
         }
         
         public function precios() {
         return $this->belongsTo('App\Precio', 'id_tarifa');
         }
         
}
