<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMovimiento extends Model
{
  public $table = 'detalle_movimiento';
    
    public $fillable = [
        'Nombre'
    ]
    ;
    public $timestamps = false;;
}
