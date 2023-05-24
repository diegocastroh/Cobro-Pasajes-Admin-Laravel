<?php

namespace App\Models;

use App\Models\Insurance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function tipoSeguro()
    {
        return $this->belongsTo(Insurance::class,'tipo_seguro_id');
    }
    public function Bus(){
        return $this->hasOne(Driver::class, 'chofer_id');

    }
}
