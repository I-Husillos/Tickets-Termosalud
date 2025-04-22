<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    // Si se desea activar el uso de timestamps (created_at y updated_at), vasta con cambiar la propiedad siguiente
    public $timestamps = true; 

    protected $fillable = ['name'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
