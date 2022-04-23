<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table='tickets';

    public function sellers()
    {
        return $this->belongsToMany(Seller::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
