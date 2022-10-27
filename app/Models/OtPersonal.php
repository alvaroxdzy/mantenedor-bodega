<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtPersonal extends Model
{
   public $table = 'ot_personal';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
