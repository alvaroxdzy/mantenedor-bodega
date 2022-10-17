<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\OrdenTrabajo;
use App\Models\Vehiculo;
use App\Models\Bodega;
use App\Models\Empleado;

class OrdenTrabajoController extends Controller
{

    public function create()

    {
        $empleado = Empleado::select('rut','nombres')->orderBy('nombres')->get();
        $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
        $vehiculo = Vehiculo::select('patente')->get();
        return view('OrdenTrabajo')->with('vehiculo',$vehiculo)->with('bodega',$bodega)->with('empleado',$empleado);

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


}
