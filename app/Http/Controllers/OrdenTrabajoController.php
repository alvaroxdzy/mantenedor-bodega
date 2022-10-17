<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\OrdenTrabajo;
use App\Models\Vehiculo;
use App\Models\Bodega;
use App\Models\Empleado;
use App\Models\Folios;

class OrdenTrabajoController extends Controller
{

  public function create()

  {
    $empleado = Empleado::select('rut','nombres')->orderBy('nombres')->get();
    $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
    $vehiculo = Vehiculo::select('patente')->get();
    $folios = Folios::select('folio','tipo')->where('tipo','OT')->first();
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


}
