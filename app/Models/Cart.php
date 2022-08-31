<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table="cart";

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Items::class, 'id', 'item_id'); 
    }
}
