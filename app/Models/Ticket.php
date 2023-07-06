<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\TicketCategory;
use App\Models\TicketPriority;
use App\Models\Customer;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'id_managing_user',
        'id_status',
        'id_type',
        'id_category',
        'id_priority',
        'id_customer',
        'title',
        'description',
        'address',
        'latitude',
        'longitude',
        'fecha_ingreso_solicitud',
        'fecha_realizar_servicio',
        'fecha_termino_servicio',
    ];

    public function managingUser()
    {
        return $this->belongsTo(User::class, 'id_managing_user');
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'id_status');
    }

    public function type()
    {
        return $this->belongsTo(TicketType::class, 'id_type');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'id_category');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class, 'id_priority');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
