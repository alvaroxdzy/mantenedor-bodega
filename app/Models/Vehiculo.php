<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
   public $table = 'vehiculos';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
