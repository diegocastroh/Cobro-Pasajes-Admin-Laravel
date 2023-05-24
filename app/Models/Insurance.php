<?php

namespace App\Models;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    public function Drivers()
    {
        return $this->hasMany(Driver::class, 'tipo_seguro_id');
    }
}
