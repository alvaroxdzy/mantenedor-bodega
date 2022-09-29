<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
   public $table = 'empleado';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
