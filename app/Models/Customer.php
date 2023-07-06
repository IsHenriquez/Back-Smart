<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $fillable = [
        'name',
        'last_name',
        'mother_last_name',
        'identification_number',
        'phone',
        'email'
    ];
}
