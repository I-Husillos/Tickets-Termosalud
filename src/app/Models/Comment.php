<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'messages';
    
    protected $fillable =[
        'ticket_id',
        'author_id',
        'author_type',
        'message',
        'created_at'
    ];


    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function author()
    {
        return $this->morphTo();
    }

}

