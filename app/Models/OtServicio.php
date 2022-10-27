<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtServicio extends Model
{
   public $table = 'ot_servicios';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
