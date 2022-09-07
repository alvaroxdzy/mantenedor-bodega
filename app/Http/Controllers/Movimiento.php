<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Bodega;
use App\Models\Producto;
use DB;



class Movimiento extends Controller
{
        public function create()
    {
      // $region = Regions::select('id','name')->get();
         $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
         $proveedor= Proveedor::select(DB::raw("CONCAT(rut_proveedor,'-',dig_rut_prov)as rut_proveedor"),'razon_social')->orderBy('razon_social')->get();
         $producto= Producto::select('id','codigo_producto','nombre_producto')->get();

        return view('movimientoIngreso')->with('proveedor',$proveedor)->with('bodega',$bodega)->with('producto',$producto);
    }

    public function traerProducto($id)
    {
        $producto =Producto::find($id);
        return $producto;
    }
}
