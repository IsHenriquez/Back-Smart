<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Customer;
use App\Models\Ticket;

class NPS extends Model
{
    protected $table = 'nps';

    protected $fillable = [
        'id_user',
        'id_customer',
        'id_ticket',
        'evaluation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }
}
