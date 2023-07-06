<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Announcement extends Model
{
    use HasFactory;
    protected $table = 'announcements';

    protected $fillable = [
        'id_announcement_user',
        'title',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_announcement_user');
    }
}
