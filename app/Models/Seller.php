<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    public function sellerType()
    {
        return $this->belongsTo(seller_type::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
