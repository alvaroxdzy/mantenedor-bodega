<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtProducto extends Model
{
    public $table = 'ot_productos';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
