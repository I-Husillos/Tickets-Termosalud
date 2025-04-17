<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'description',
        'type',
        'priority',
        'status',
        'user_id',
        'admin_id',
        'resolved_at'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }

    
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}

