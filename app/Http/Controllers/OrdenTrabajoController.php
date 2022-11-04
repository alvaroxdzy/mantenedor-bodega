<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\OrdenTrabajo;
use App\Models\Vehiculo;
use App\Models\Bodega;
use App\Models\Empleado;
use App\Models\Folios;
use App\Models\OtPersonal;
use App\Models\OtProducto;
use App\Models\OtServicio;
use App\Models\Movimiento;
use App\Models\DetalleMovimiento;


class OrdenTrabajoController extends Controller
{

  public function create()

  {
    $empleado = Empleado::select('rut','nombres')->orderBy('nombres')->get();
    $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
    $vehiculo = Vehiculo::select('patente')->get();
    $folios = Folios::select('folio')->where('tipo','OT')->first();
    return view('OrdenTrabajo')->with('vehiculo',$vehiculo)->with('bodega',$bodega)->with('empleado',$empleado)->with('folios',$folios);

  }

  public function traerVehiculo($patente)
  {
    $vehiculo =Vehiculo::where('patente',$patente)->first();
    return $vehiculo;
  }

  public function traerEmpleados()
  {
    $empleado =Empleado::orderBy('nombres')->get();
    return $empleado;
  }


  public function traerDetalleEmpleado($nombres)
  {
    $detalleEmpleado =Empleado::where('nombres',$nombres)->first();
    return $detalleEmpleado;

  }


  public function promedioNeto($codigo_producto)
  {

    $promedio = DB::table('detalle_movimiento')->where('tipo','INGRESO')->where('cod_producto',$codigo_producto)->avg('neto');


    return $promedio;
  }

  public function storeSalida(Request $request)
  {
    $movimiento =new Movimiento();
    $movimiento->tipo_documento='ORDEN DE TRABAJO';
    $movimiento->num_documento=$request->num_documento;
    $movimiento->cod_bodega=$request->cod_bodega;
    $movimiento->fecha=$request->fecha;     
    $movimiento->tipo='SALIDA';
    $movimiento->estado='DISPONIBLE';
    $movimiento->usuario=$request->usuario;


    $arrayProductos = $request->arrayProductos;
    if($arrayProductos) {
      foreach ($arrayProductos as $datos) {

       $detalle = new DetalleMovimiento();
       $detalle->nro_documento_mov=$request->num_documento;
       $detalle->cod_producto=$datos['cod_producto'];
       $detalle->tipo_documento='ORDEN DE TRABAJO';
       $detalle->nombre_producto=$datos['producto'];
       $detalle->cantidad=$datos['cantidad'];
       $detalle->neto=$datos['precio'];
       $detalle->total=$datos['precio'];
       $detalle->fecha=$request->fecha;  
       $detalle->tipo='SALIDA';
       $detalle->usuario=$request->usuario;
       $detalle->patente=$request->patente;
       $detalle->save();
     }

     $movimiento->save();

     $tipo_documento = 'ORDEN DE TRABAJO';
     if($tipo_documento=='ORDEN DE TRABAJO'){
      $folio =DB::table('folios')
      ->where('tipo','OT')
      ->update(['folio' => $request->num_documento+1]);
    }     
  }
  return "LISTASO";
}

public function storeOT(Request $request)
{
  $ot_validar = OrdenTrabajo::where('num_documento',$request->num_documento)->first();
  if ($ot_validar) {
    return redirect()->back()->with('message', 'FOLIO VENCIDO , INTENTE NUEVAMENTE');

  } else {


    $orden = new OrdenTrabajo();
    $orden->solicitante=$request->solicitante;
    $orden->usuario=$request->usuario;
    $orden->patente=$request->patente;
    $orden->tipo_camion=$request->tipo_camion;
    $orden->marca=$request->marca;
    $orden->modelo=$request->modelo;
    $orden->anio=$request->anio;
    $orden->fecha=$request->fecha;
    $orden->num_documento=$request->num_documento;
    $orden->cod_bodega=$request->cod_bodega;
    $orden->diagnostico=$request->diagnostico;
    $orden->trabajos_realizados=$request->trabajos_realizados;
    $orden->observaciones=$request->observaciones;
    $orden->save();

    $arrayEmpleados = $request->arrayPersonal;
    if($arrayEmpleados) {

     foreach ($arrayEmpleados as $empleados) {

       $otPersonal = new OtPersonal();
       $otPersonal->nombres=$empleados['empleado'];
       $otPersonal->rut=$empleados['rut'];
       $otPersonal->cargo=$empleados['cargo'];
       $otPersonal->fecha_inicio=$empleados['fecha_inicio'];
       $otPersonal->fecha_termino=$empleados['fecha_termino'];
       $otPersonal->detalle=$empleados['detalle'];
       $otPersonal->num_documento=$request->num_documento;
       $otPersonal->save();
     }
   }


   $arrayProducto = $request->arrayProductos;
   if($arrayProducto) {

     foreach ($arrayProducto as $producto) {

      $otProducto = new otProducto();
      $otProducto->cod_producto=$producto['cod_producto'];
      $otProducto->producto=$producto['producto'];
      $otProducto->cantidad=$producto['cantidad'];
      $otProducto->precio=$producto['precio'];
      $otProducto->num_documento=$request->num_documento;
      $otProducto->save();
    }
  }

  $arrayServicio = $request->arrayServicios;
  if($arrayServicio) {

   foreach ($arrayServicio as $servicio) {

    $otServicio = new otServicio();
    $otServicio->servicio=$servicio['servicio'];
    $otServicio->descripcion_servicio=$servicio['descripcion_servicio'];
    $otServicio->valor_servicio=$servicio['valor_servicio'];
    $otServicio->num_documento=$request->num_documento;
    $otServicio->save();
  }
}
return "LISTASO";
}
}


public function edit($num_documento)
{
    $ordenTrabajo = OrdenTrabajo::where('num_documento',$num_documento)->first();

    $empleado = Empleado::select('rut','nombres')->orderBy('nombres')->get();
    $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
    $vehiculo = Vehiculo::select('patente')->get();
    $folios = Folios::select('folio')->where('tipo','OT')->first();

    return view('modificarOrdenTrabajo')->with('ordenTrabajo',$ordenTrabajo)->with('vehiculo',$vehiculo)->with('bodega',$bodega)->with('empleado',$empleado)->with('folios',$folios);
}

public function update(Request $request)  
{

    $vehiculo =Vehiculo::find($request->patente);
    $vehiculo->patente=$request->patente; 
    $vehiculo->tipo_camion=$request->tipo_camion; 
    $vehiculo->marca=$request->marca; 
    $vehiculo->modelo=$request->modelo; 
    $vehiculo->anio=$request->anio;        
    $vehiculo->save();
   // return redirect(route('bodega.search'));
    return redirect()->back()->with('message', 'VEHICULO ACTUALIZADO CORRECTAMENTE');
}



public function traerOT(Request $request)
{
  $folio = $request->num_documento;

  $ot = OrdenTrabajo::where('num_documento',$folio)->first();
  $otPersonal = OtPersonal::where('num_documento',$folio)->get();
  $otProducto = OtProducto::select('id','cod_producto','producto', DB::raw('SUBSTR(cantidad,2) as cantidad'),'precio','num_documento')->where('num_documento',$folio)->get();
  $otServicio = OtServicio::where('num_documento',$folio)->get();
  return [$ot, $otPersonal, $otProducto , $otServicio]; 
}

public function eliminarPersonal($id)
{
  $personal = OtPersonal::find($id);
  $personal->delete();
  return 1;
}

public function eliminarProducto($id)
{
  $productoOT = OtProducto::find($id);
  $productoOT->delete();
  return 1;
}

public function eliminarServicio($id)
{
  $servicioOT = OtServicio::find($id);
  $servicioOT->delete();
  return 1;
}

}

