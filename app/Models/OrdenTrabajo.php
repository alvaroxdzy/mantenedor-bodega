<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
  public $table = 'orden_trabajo';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;
}
