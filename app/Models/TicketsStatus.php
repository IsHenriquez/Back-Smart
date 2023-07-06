<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsStatus extends Model
{
    protected $table = 'tickets_status';

    protected $fillable = [
        'name', 'description'
    ];
}
