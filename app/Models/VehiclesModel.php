<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VehiclesBrand;

class VehiclesModel extends Model
{
    use HasFactory;

    protected $table = 'vehicles_model';

    protected $fillable = [
        'id_vehicles_brand',
        'name'
    ];

    public function brand()
    {
        return $this->belongsTo(VehiclesBrand::class, 'id_vehicles_brand');
    }
}
