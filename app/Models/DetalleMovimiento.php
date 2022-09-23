<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMovimiento extends Model
{
  public $table = 'detalle_movimiento';
    
    public $fillable = [
        'nro_documento_mov',
        'codigo_producto',
        'cantidad',
        'orden_trabajo',
        'valor',
        'total',
        'iva'
    ]
    ;
    public $timestamps = false;
}
