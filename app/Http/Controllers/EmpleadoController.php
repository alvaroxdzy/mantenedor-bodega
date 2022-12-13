<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Bodega;
use DB;
use PDF;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

 public function create()
 {
  return view('crearEmpleado');
}


public function store(Request $request)
{
  $rutValidar = Empleado::where('rut',$request->rut)->first();
  if ($rutValidar) {
    $empleadoUpdate = DB::table('empleado')
    ->where('rut',$request->rut)
    ->update(['nombres' => $request->nombres,
      'cargo' => $request->caargo]);

    return redirect()->back()->with('message', 'EMPLEADO ACTUALIZADO');

  }
  $empleado =new Empleado();
  $empleado->rut=$request->rut; 
  $empleado->nombres=$request->nombres; 
  $empleado->cargo=$request->cargo;     
  $empleado->save();

  return redirect()->back()->with('message', 'EMPLEADO GRABADO');
}



public function search(Request $request)
{
  $empleado=Empleado::all();
  return view('busquedaEmpleado',compact('empleado'));
}

public function traerEmpleado(Request $request)
{
  $rut = $request->rut;

  $empleado = Empleado::where('rut',$rut)->first();
  return $empleado;
}

public function edit($id)
{
 $empleado = Empleado::where('rut',$id)->first();
 return view('modificarEmpleado')->with('empleado',$empleado) ;
}


public function update(Request $request)
{
 $empleado =Empleado::find($request->id);
 $empleado->rut=$request->rut; 
 $empleado->nombres=$request->nombres; 
 $empleado->cargo=$request->cargo; 
 $empleado->save();
 return redirect(route('empleado.search'));
}

public function inventarioEmpleados()
{
 $inventarioEmpleado = DB::select('SELECT empleado.rut ,nombres , substring(sum(cantidad),2) as "productos_entregados"  FROM `detalle_movimiento` join empleado on empleado.rut = detalle_movimiento.rut 
   GROUP by empleado.rut , nombres ');

 if ($inventarioEmpleado==null){
  return redirect()->back()->withErrors(['msg' => 'The Message']);;
} else {
 return view('empleadoInventario')->with('inventarioEmpleado',$inventarioEmpleado);
}
}


public function productoHistorial($rut){


 $empleado = DB::select('select detalle_movimiento.tipo_documento, nro_documento_mov , cod_producto , nombre_producto , substring(cantidad,2) as cantidad, detalle_movimiento.fecha , bodega.nombre_bodega from detalle_movimiento join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov join bodega on bodega.codigo_bodega = detalle_movimiento.cod_bodega where rut = "'.$rut.'" ');

 $trabajador = Empleado::where('rut',$rut)->first();

 return view('historialEmpleado',compact('empleado'))->with('trabajador',$trabajador);

}

public function InventarioBodegaPDF($cod_bodega){

  $inventarioEmpleadoPDF = DB::select('SELECT empleado.rut ,nombres , substring(sum(cantidad),2) as "productos_entregados"  FROM `detalle_movimiento` join empleado on empleado.rut = detalle_movimiento.rut 
   GROUP by empleado.rut , nombres ');
 
 $data = [
   'inventarioEmpleadoPDF' => $inventarioEmpleadoPDF
 ];
 $pdf = PDF::loadView('empleadosInventarioPDF',$data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');
 return $pdf->download('Inventario-empleado.pdf');
}


public function empleadoMovimientoPDF($rut){

 $movimiento = DB::select('select detalle_movimiento.tipo_documento, nro_documento_mov , cod_producto , nombre_producto , substring(cantidad,2) as cantidad, detalle_movimiento.fecha from detalle_movimiento join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov where rut = "'.$rut.'" ');

 $empleado = Empleado::where('rut',$rut)->first();

 $data = [
  'movimiento' => $movimiento,
  'empleado' => $empleado
];

$pdf = PDF::loadView('historialEmpleadoPDF',$data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');

return $pdf->download('archivo-pdf.pdf');

}



}
