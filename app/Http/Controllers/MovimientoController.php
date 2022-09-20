<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Bodega;
use App\Models\Producto;
use App\Models\Movimiento;
use DB;



class MovimientoController extends Controller
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

    public function modalProveedor()
    {
    $proveedores=Proveedor::all();
    return $proveedores;
    }

        public function store(Request $request)
    {
        $movimiento_validar = Movimiento::where('num_documento',$request->num_documento)->first();
        if ($movimiento_validar) {
           return redirect()->back()->with('error', 'ERROR CODIGO MOVIMIENTO EXISTENTE');
       }
 
       $movimiento = $request->get('arrayDatos');




       $movimiento =new Movimiento();
       $movimiento->tipo_documento=$request->tipo_documento;
       $movimiento->num_documento=$request->num_documento;
       $movimiento->rut_proveedor=$request->rut_proveedor; 
       $movimiento->cod_bodega=$request->cod_bodega;
       $movimiento->fecha=$request->fecha;     
       $movimiento->tipo=$request->tipo;
       $movimiento->estado=$request->estado;
       $movimiento->save();

          //  if ($bodega->save()) {
       return redirect()->back()->with('message', 'Movimiento creado correctamente');
   }

}
