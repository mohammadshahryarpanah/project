<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'city'
    ];

    public function seller()
    {
        return $this->hasOne(seller_type::class);
    }
}
