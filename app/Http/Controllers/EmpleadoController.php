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
     return redirect()->back()->with('error', 'ERROR RUT TRABAJADOR EXISTE');
  }
  $empleado =new Empleado();
  $empleado->rut=$request->rut; 
  $empleado->nombres=$request->nombres; 
  $empleado->cargo=$request->cargo;     
  $empleado->save();

          //  if ($bodega->save()) {
  return redirect()->back()->with('message', 'Empleado creado correctamente');
}


public function search(Request $request)
{
  $empleado=Empleado::all();
  return view('busquedaEmpleado',compact('empleado'));
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
  
 $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get()->unique('codigo_bodega','nombre_bodega');

 $inventarioEmpleado = DB::select('SELECT empleado.rut ,nombres , substring(sum(cantidad),2) as "productos_entregados" , nombre_bodega FROM `detalle_movimiento` join empleado on empleado.rut = detalle_movimiento.rut join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov join bodega on bodega.codigo_bodega = movimiento.cod_bodega 
   where estado="DISPONIBLE" 
   GROUP by empleado.rut , nombres , nombre_bodega');

 return view('empleadoInventario')->with('bodega',$bodega)->with('inventarioEmpleado',$inventarioEmpleado);
}

public function filtrarInventario(Request $request){
  $cod_bodega=$request->cod_bodega;

  if($cod_bodega == 'TODAS LAS BODEGAS')
  {
    $empleado = DB::select('SELECT empleado.rut ,nombres , substring(sum(cantidad),2) as "productos_entregados" , nombre_bodega FROM `detalle_movimiento` join empleado on empleado.rut = detalle_movimiento.rut join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov join bodega on bodega.codigo_bodega = movimiento.cod_bodega 
      WHERE estado="DISPONIBLE"
      GROUP by empleado.rut , nombres , nombre_bodega');

 }else{
    $empleado = DB::select('SELECT empleado.rut ,nombres , substring(sum(cantidad),2) as "productos_entregados" , nombre_bodega FROM `detalle_movimiento` join empleado on empleado.rut = detalle_movimiento.rut join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov join bodega on bodega.codigo_bodega = movimiento.cod_bodega 
      WHERE cod_bodega="'.$cod_bodega.'" and estado="DISPONIBLE"
      GROUP by empleado.rut , nombres , nombre_bodega');
 }

 return $empleado;
}

public function productoHistorial($rut){


 $empleado = DB::select('select tipo_documento, nro_documento_mov , cod_producto , nombre_producto , substring(cantidad,2) as cantidad, detalle_movimiento.fecha from detalle_movimiento join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov where rut = "'.$rut.'" ');

 $trabajador = Empleado::where('rut',$rut)->first();

 return view('historialEmpleado',compact('empleado'))->with('trabajador',$trabajador);

}

public function InventarioBodegaPDF($cod_bodega){

   if($cod_bodega == 'TODAS LAS BODEGAS')
   {
     $inventarioEmpleadoPDF = DB::select('SELECT empleado.rut ,nombres , substring(sum(cantidad),2) as "productos_entregados" , nombre_bodega FROM `detalle_movimiento` join empleado on empleado.rut = detalle_movimiento.rut join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov join bodega on bodega.codigo_bodega = movimiento.cod_bodega 
      where estado="DISPONIBLE" 
      GROUP by empleado.rut , nombres , nombre_bodega');
  }else{
     $inventarioEmpleadoPDF = DB::select('SELECT empleado.rut ,nombres , substring(sum(cantidad),2) as "productos_entregados" , nombre_bodega FROM `detalle_movimiento` join empleado on empleado.rut = detalle_movimiento.rut join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov join bodega on bodega.codigo_bodega = movimiento.cod_bodega 
      WHERE cod_bodega="'.$cod_bodega.'" and estado="DISPONIBLE"
      GROUP by empleado.rut , nombres , nombre_bodega');
  }
  $data = [
     'inventarioEmpleadoPDF' => $inventarioEmpleadoPDF
  ];
  $pdf = PDF::loadView('empleadosInventarioPDF',$data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');
  return $pdf->download('Inventario-empleado.pdf');
}

public function empleadoMovimientoPDF($rut){

   $movimiento = DB::select('select tipo_documento, nro_documento_mov , cod_producto , nombre_producto , substring(cantidad,2) as cantidad, detalle_movimiento.fecha from detalle_movimiento join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov where rut = "'.$rut.'" ');

$empleado = Empleado::where('rut',$rut)->first();

  $data = [
    'movimiento' => $movimiento,
    'empleado' => $empleado
];

$pdf = PDF::loadView('historialEmpleadoPDF',$data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');


return $pdf->download('archivo-pdf.pdf');

}



}
