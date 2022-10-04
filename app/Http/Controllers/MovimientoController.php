<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Bodega;
use App\Models\Producto;
use App\Models\Movimiento;
use App\Models\Empleado;
use App\Models\DetalleMovimiento;
use App\Models\Vehiculo;
use DB;



class MovimientoController extends Controller
{

  public function create()
  {
      // $region = Regions::select('id','name')->get();
   $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
   $proveedor= Proveedor::select(DB::raw("CONCAT(rut_proveedor,'-',dig_rut_prov)as rut_proveedor"),'razon_social')->orderBy('razon_social')->get();
   $producto= Producto::select('id','codigo_producto','nombre_producto')->get();
   $empleado = Empleado::select('rut','nombres')->get();

   return view('movimientoIngreso')->with('proveedor',$proveedor)->with('bodega',$bodega)->with('producto',$producto)->with('empleado',$empleado);
 }

 public function salida()
 {
  $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
  $empleado = Empleado::select('rut','nombres')->get();
  $producto= Producto::select('id','codigo_producto','nombre_producto')->get();
  $vehiculo = Vehiculo::select('patente')->get();


  return view('movimientoSalida')->with('empleado',$empleado)->with('producto',$producto)->with('bodega',$bodega)->with('vehiculo',$vehiculo);
}

public function traerProducto($id)
{
  $producto =Producto::find($id);
  return $producto;

}

public function traerStock($cod_producto){

  $stock = DB::table('detalle_movimiento')
    ->select(array( DB::raw('(SUM(cantidad)) as stock')))->Where('cod_producto',$cod_producto)
    ->get();
    return $stock;
}




public function store(Request $request)
{

  $movimiento_validar = Movimiento::where('num_documento',$request->num_documento)->first();
  if ($movimiento_validar) {
    return 'YA ESTA EN USO EL NUMERO DE DOCUMENTO';
  }

  $movimiento =new Movimiento();
  $movimiento->tipo_documento=$request->tipo_documento;
  $movimiento->num_documento=$request->num_documento;
  $movimiento->cod_bodega=$request->cod_bodega;
  $movimiento->fecha=$request->fecha;     
  $movimiento->tipo=$request->tipo;
  $movimiento->estado=$request->estado;
  $movimiento->usuario=$request->usuario;


  $arrayDatos = $request->arrayMovimiento;

  foreach ($arrayDatos as $datos) {

   $detalle = new DetalleMovimiento();
   $detalle->nro_documento_mov=$request->num_documento;
   $detalle->cod_producto=$datos['selectProducto'];
   $detalle->nombre_producto=$datos['nombre_producto'];
   $detalle->cantidad=$datos['cantidad'];
   $detalle->neto=$datos['valoress'];
   $detalle->iva=$datos['iva'];
   $detalle->total=$datos['total'];
   $detalle->rut_proveedor=$request->rut_proveedor; 
   $detalle->fecha=$request->fecha;  
   $detalle->tipo=$request->tipo;
   $detalle->usuario=$request->usuario;
   $detalle->save();
 }
 $movimiento->save();

 return "LISTASO";
}

}
