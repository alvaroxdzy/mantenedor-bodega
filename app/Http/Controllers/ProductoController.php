<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Bodega;

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
        $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get()->unique('nombre_bodega'); 
        return view('crearProducto')->with('bodega',$bodega);
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
       $producto->usuario=$request->usuario;   
       $producto->save();

          //  if ($bodega->save()) {
       return redirect()->back()->with('message', 'producto creado correctamente');
   }

   public function search()
   {
  //if(isset($_GET['query'])){
  //    $search_text = $_GET['query'];
  //    $productos = Producto::where('nombre_producto','LIKE','%'.$search_text.'%')
  //    ->orWhere('codigo_producto','LIKE','%'.$search_text.'%')
  //    ->orWhere('observacion_producto','LIKE','%'.$search_text.'%')
  //    ->orWhere('cod_bod_producto','LIKE','%'.$search_text.'%')
  //    ->get();
  //} else
    
        $productos=Producto::join('bodega','producto.cod_bod_producto', '=','bodega.codigo_bodega')->select('producto.id','producto.codigo_producto','producto.nombre_producto', 'producto.observacion_producto' , 'bodega.nombre_bodega as nombre_bodega')->get();



    
    return view('busquedaProducto',compact('productos'));
    }

    public function update(Request $request)  
    {

     $producto =Producto::find($request->id);
     $producto->codigo_producto=$request->codigo_producto; 
     $producto->nombre_producto=$request->nombre_producto; 
     $producto->observacion_producto=$request->observacion_producto; 
     $producto->cod_bod_producto=$request->cod_bod_producto;  
     $producto->save();
     return redirect(route('producto.search'));
    }

    public function edit($id)
    {
    $producto = Producto::where('codigo_producto',$id)->first();
    
    $cod_bodega = Producto::leftjoin('bodega','producto.cod_bod_producto', '=','bodega.codigo_bodega')
    ->select('producto.codigo_producto','bodega.codigo_bodega as codigo_bodega','bodega.nombre_bodega as nombre_bodega')
    ->where('producto.codigo_producto',$id)->first();

    $nombre_bodega = Bodega::select('codigo_bodega','nombre_bodega')->get()->unique('codigo_bodega','nombre_bodega');

    //$productos = Producto::leftjoin('bodega','producto.cod_bod_producto', '=','bodega.codigo_bodega')->select('producto.cod_bod_producto','bodega.comuna_bodega')->get()->unique('comuna_bodega');

    return view('modificarProducto')->with('producto',$producto)->with('cod_bodega', $cod_bodega)->with('nombre_bodega', $nombre_bodega);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect(route('producto.search'));

    }

}