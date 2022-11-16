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


class VehiculoController extends Controller
{
 public function create()
 {
    return view('crearVehiculo');
}

public function store(Request $request)
{
    $patente = Vehiculo::where('patente',$request->patente)->first();
    if ($patente) {
       $vehiculoUpdate = DB::table('vehiculos')
       ->where('patente',$request->patente)
       ->update(['tipo_equipo' => $request->tipo_equipo,
          'marca' => $request->marca,
          'modelo' => $request->modelo,
          'anio' => $request->anio]);
       return redirect()->back()->with('message', 'VEHICULO ACTUALIZADO CORRECTAMENTE');
   }
   $vehiculo =new Vehiculo();
   $vehiculo->patente=$request->patente; 
   $vehiculo->tipo_equipo=$request->tipo_equipo; 
   $vehiculo->marca=$request->marca; 
   $vehiculo->modelo=$request->modelo; 
   $vehiculo->anio=$request->anio;        
   $vehiculo->save();

   return redirect()->back()->with('message', 'VEHICULO REGISTRADO CORRECTAMENTE');
}

public function edit($patente)
{
    $vehiculo = Vehiculo::where('patente',$patente)->first();

    return view('modificarVehiculo')->with('vehiculo',$vehiculo);
}

public function update(Request $request)  
{

    $vehiculo =Vehiculo::find($request->patente);
    $vehiculo->patente=$request->patente; 
    $vehiculo->tipo_equipo=$request->tipo_equipo; 
    $vehiculo->marca=$request->marca; 
    $vehiculo->modelo=$request->modelo; 
    $vehiculo->anio=$request->anio;        
    $vehiculo->save();
   // return redirect(route('bodega.search'));
    return redirect()->back()->with('message', 'VEHICULO ACTUALIZADO CORRECTAMENTE');
}

public function search()
{
    $vehiculo=vehiculo::all();
    return view('busquedaVehiculo',compact('vehiculo'));
}

public function traerVehiculo(Request $request)
{

    $patente = Vehiculo::where('patente',$request->patente)->first();
    return $patente;
}

}
