<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class communes extends Model
{
  public $table = 'communes';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
