<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclesBrand extends Model
{
    use HasFactory;

    protected $table = 'vehicles_brand';
    protected $fillable = [
        'name',
    ];
}
