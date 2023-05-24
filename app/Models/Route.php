<?php

namespace App\Models;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public function Bus()
    {
        return $this->hasMany(Bus::class,'ruta_id');
    }

    public function Ticket(){
        return $this->hasMany(Ticket::class,'ruta_id');
    }
}
