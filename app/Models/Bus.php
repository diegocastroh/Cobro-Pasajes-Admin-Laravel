<?php

namespace App\Models;

use App\Models\Driver;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //Relación Uno a Uno
    public function Driver()
    {
        return $this->belongsTo(Driver::class,'chofer_id');
    }

    public function Route()
    {
        return $this->belongsTo(Route::class,'ruta_id');
    }
}
