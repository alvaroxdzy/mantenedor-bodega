<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class regions extends Model
{
public $table = 'regions';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
