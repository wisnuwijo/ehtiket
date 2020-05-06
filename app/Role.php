<?php

namespace Ehtiket;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'table_roles';

    public function user()
    {
        return $this->hasMany('App\User','role_id');
    }
}
