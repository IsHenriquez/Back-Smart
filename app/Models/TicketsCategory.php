<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsCategory extends Model
{
    protected $table = 'tickets_category';

    protected $fillable = [
        'name', 'description'
    ];
}
