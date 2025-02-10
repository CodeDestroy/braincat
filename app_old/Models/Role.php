<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }

}
