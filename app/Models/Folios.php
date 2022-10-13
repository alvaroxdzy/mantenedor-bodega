<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folios extends Model
{
   public $table = 'folios';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
