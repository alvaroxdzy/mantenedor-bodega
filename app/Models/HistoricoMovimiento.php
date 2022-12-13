<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoMovimiento extends Model
{
    public $table = 'historico_movimiento';
    
    public $fillable = [
        'nro_documento_mov',
        'codigo_producto',
        'nombre_producto',
        'cantidad',
        'orden_trabajo',
        'valor',
        'total',
        'iva',
        'usuario'
    ]
    ;
    public $timestamps = false;
}
