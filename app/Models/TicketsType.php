<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsType extends Model
{
    protected $table = 'tickets_type';

    protected $fillable = [
        'name', 'description'
    ];
}
