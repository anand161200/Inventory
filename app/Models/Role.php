<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table="roles";

    protected $guarded = [];

    public function permission()
    {
        return $this->belongsToMany(permission::class,'role_permission' , 'role_id', 'permission_id');
    }
}
