<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $table="brands";

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Items::class,'brand_id','id');
    }
}
