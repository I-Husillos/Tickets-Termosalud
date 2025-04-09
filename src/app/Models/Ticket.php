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




}

