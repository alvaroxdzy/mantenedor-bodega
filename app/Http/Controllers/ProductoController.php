<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function consultaProductos()
    {
        $producto=Producto::get() ;
        
        return $producto;
    }

    public function create()
    {
        return view('crearProducto');
    }    

    public function store(Request $request)
    {

     $productoprueba = Producto::where('codigo_producto',$request->codigo_producto)->first();
     if ($productoprueba) {
         return redirect()->back()->with('error', 'ERROR CODIGO PRODUCTO EXISTENTE');
     }
     $producto =new Producto();
     $producto->codigo_producto=$request->codigo_producto; 
     $producto->nombre_producto=$request->nombre_producto; 
     $producto->observacion_producto=$request->observacion_producto; 
     $producto->cod_bod_producto=$request->cod_bod_producto;     
     $producto->save();

          //  if ($bodega->save()) {
     return redirect()->back()->with('message', 'producto creado correctamente');
 }
}
