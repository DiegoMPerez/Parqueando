<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission {

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'display_name', 'description'];
    
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

}
