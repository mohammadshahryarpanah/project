<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seller_type extends Model
{
    use HasFactory;
    protected $table='seller_type';

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function sellers()
    {
        return $this->hasMany(Seller::class);
    }
}
