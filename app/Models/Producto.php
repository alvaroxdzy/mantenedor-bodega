<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $table = 'producto';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
