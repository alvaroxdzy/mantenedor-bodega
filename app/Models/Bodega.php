<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    public $table = 'bodega';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;

}
