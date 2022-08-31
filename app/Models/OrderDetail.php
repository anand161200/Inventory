<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $table="order_detail";

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(checkout::class, 'id' , 'checkout_id');
    }

    public function orderdetails()
    {
        return $this->hasMany(Items::class, 'id', 'item_id');
    }
}
