<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission {

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

}
