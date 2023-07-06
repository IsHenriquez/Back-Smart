<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsPriority extends Model
{
    protected $table = 'tickets_priority';

    protected $fillable = [
        'name', 'description'
    ];
}
