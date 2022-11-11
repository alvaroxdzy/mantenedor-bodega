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
use App\Models\Folios;



class MovimientoController extends Controller
{

 public function __construct()
 {
  $this->middleware('auth');
}
public function create()
{
      // $region = Regions::select('id','name')->get();
 $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
 $proveedor= Proveedor::select( 'rut_proveedor','razon_social')->orderBy('razon_social')->get();
 $productos=Producto::join('bodega','producto.cod_bod_producto', '=','bodega.codigo_bodega')->select('producto.codigo_producto','producto.nombre_producto', 'producto.observacion_producto' , 'bodega.nombre_bodega as nombre_bodega' , 'bodega.codigo_bodega as cod_bodega')->get();
 $empleado = Empleado::select('rut','nombres')->orderBy('nombres')->get();
 $folio = Folios::select('folio')->where('tipo','CI')->first();



 return view('movimientoIngreso')->with('proveedor',$proveedor)->with('bodega',$bodega)->with('empleado',$empleado)->with('productos',$productos)->with('folio',$folio);
}

public function productosBodega(Request $request){
  $producto = Producto::where('cod_bod_producto',$request->cod_bodega)->get();
  return $producto;
}


public function salida()
{
  $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
  $empleado = Empleado::select('rut','nombres')->orderBy('nombres')->get();
  $producto= Producto::select('codigo_producto','nombre_producto')->get();
  $productos=Producto::join('bodega','producto.cod_bod_producto', '=','bodega.codigo_bodega')->select('producto.codigo_producto','producto.nombre_producto', 'producto.observacion_producto' , 'bodega.nombre_bodega as nombre_bodega' , 'bodega.codigo_bodega as cod_bodega')->get();
  $vehiculo = Vehiculo::select('patente')->get();
   $folios = Folios::select('folio')->where('tipo','CS')->first();

  return view('movimientoSalida')->with('empleado',$empleado)
  //->with('producto',$producto)
  ->with('bodega',$bodega)->with('vehiculo',$vehiculo)->with('folios',$folios)->with('productos',$productos);
}

public function traerProducto($cod_producto,$cod_bodega)
{
  $producto =Producto::where('codigo_producto',$cod_producto)->where('cod_bod_producto',$cod_bodega)->get();
  return view('welcome');

}

public function traerStock($cod_producto,$cod_bodega){

  $stock = DB::table('detalle_movimiento')->join('movimiento','detalle_movimiento.nro_documento_mov', '=','movimiento.num_documento')
  ->select(array( DB::raw('(SUM(cantidad)) as stock')))->Where('cod_producto',$cod_producto)->where('cod_bodega',$cod_bodega)
  ->get();
  return $stock;
}




public function store(Request $request)
{

  $movimiento_validar = Movimiento::where('num_documento',$request->num_documento)->where('tipo_documento',$request->tipo_documento)->first();
  if ($movimiento_validar) {
   return back()->with('error', 'ERROR CODIGO MOVIMIENTO EXISTENTE');
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
   $detalle->tipo_documento=$request->tipo_documento;
   $detalle->rut_proveedor=$request->rut_proveedor; 
   $detalle->fecha=$request->fecha;  
   $detalle->tipo=$request->tipo;
   $detalle->usuario=$request->usuario;
   $detalle->rut=$request->rut;
   $detalle->patente=$request->patente;
   $detalle->save();
 }
 $movimiento->save();

 $tipo_documento = $request->tipo_documento;
 if($tipo_documento=='COMPROBANTE DE INGRESO'){
  $folio =DB::table('folios')
  ->where('tipo','CI')
  ->update(['folio' => $request->num_documento+1]);
}
if($tipo_documento=='COMPROBANTE SALIDA'){
  $folio =DB::table('folios')
  ->where('tipo','CS')
  ->update(['folio' => $request->num_documento+1]);
}



return "LISTASO";
}

public function buscarMovimiento(){
  $movimiento = Movimiento::join('bodega','movimiento.cod_bodega', '=','bodega.codigo_bodega')->select('movimiento.num_documento','movimiento.tipo_documento','movimiento.tipo', 'movimiento.fecha' , 'movimiento.estado' , 'movimiento.usuario' , 'bodega.nombre_bodega as nombre_bodega')->get();

  return view('busquedaMovimiento')->with('movimiento',$movimiento);
}

public function cargarDetalleMovimiento($num_documento,$tipo_documento)
{
  $detalleMovimiento = DetalleMovimiento::All()->where('nro_documento_mov',$num_documento)->where('tipo_documento',$tipo_documento);

  $movimiento = Movimiento::join('bodega','movimiento.cod_bodega', '=','bodega.codigo_bodega')->select('movimiento.num_documento','movimiento.tipo_documento','movimiento.tipo', 'movimiento.fecha' , 'movimiento.estado' , 'movimiento.usuario' , 'bodega.nombre_bodega as nombre_bodega')->where('num_documento',$num_documento)->where('tipo_documento',$tipo_documento)->first();

  return view('busquedaDetalleMovimiento')->with('detalleMovimiento',$detalleMovimiento)->with('movimiento',$movimiento);

}



}
