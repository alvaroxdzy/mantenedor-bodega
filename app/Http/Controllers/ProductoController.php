<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Bodega;
use App\Models\Movimiento;
use App\Models\Empleado;
use App\Models\DetalleMovimiento;
use Intervention\Image\Facades\Image;
use DB;
use PDF;

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
       //$producto->imagen=$request->imagen;  
       $producto->save();

          //  if ($bodega->save()) {
       return redirect()->back()->with('message', 'producto creado correctamente');
   }

   public function search()
   {

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

public function inventario()
{
    $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get()->unique('codigo_bodega','nombre_bodega');
   // $producto = DB::select('SELECT cod_producto , nombre_producto , nombre_bodega, sum(cantidad) as stock FROM detalle_movimiento join movimiento on detalle_movimiento.//nro_documento_mov = movimiento.num_documento join bodega on movimiento.cod_bodega = bodega.codigo_bodega 
   // GROUP by cod_producto , nombre_producto , nombre_bodega');
    $producto = DetalleMovimiento::join('movimiento','detalle_movimiento.nro_documento_mov','movimiento.num_documento')
    ->join('bodega','movimiento.cod_bodega','bodega.codigo_bodega')
    ->select('cod_producto','nombre_producto','nombre_bodega', DB::raw('SUM(detalle_movimiento.cantidad) as stock'),DB::raw('avg(detalle_movimiento.neto) as precio'))
    ->groupBy('detalle_movimiento.cod_producto' , 'detalle_movimiento.nombre_producto' , 'bodega.nombre_bodega')
    ->get();

    return view('productoStock')->with('bodega',$bodega)->with('producto',$producto);
}


public function filtrarInventario(Request $request){
    $cod_bodega=$request->cod_bodega;
    $fecha_desde=$request->fecha_desde;
    $fecha_hasta=$request->fecha_hasta;


    if($cod_bodega == 'TODAS LAS BODEGAS')
    {
        $producto = DB::select('SELECT cod_producto , nombre_producto , TRUNCATE(AVG(neto),0) as neto ,nombre_bodega,  sum(cantidad) as cantidad FROM detalle_movimiento join movimiento on detalle_movimiento.nro_documento_mov = movimiento.num_documento join bodega on movimiento.cod_bodega = bodega.codigo_bodega 
            WHERE estado = "DISPONIBLE"
            GROUP by cod_producto , nombre_producto , nombre_bodega ');
    }else{
        $producto = DB::select('SELECT cod_producto , nombre_producto , TRUNCATE(AVG(neto),0) as neto ,nombre_bodega,  sum(cantidad) as cantidad FROM detalle_movimiento join movimiento on detalle_movimiento.nro_documento_mov = movimiento.num_documento join bodega on movimiento.cod_bodega = bodega.codigo_bodega 
            WHERE cod_bodega="'.$cod_bodega.'" and estado="DISPONIBLE"
            GROUP by cod_producto , nombre_producto , nombre_bodega ');
    }

    return $producto;
}

public function productoHistorial($cod_producto){

  $movimiento = DB::select('SELECT nro_documento_mov ,movimiento.tipo_documento, cod_producto , nombre_producto , detalle_movimiento.tipo , detalle_movimiento.fecha, detalle_movimiento.cantidad , detalle_movimiento.usuario , movimiento.estado FROM detalle_movimiento join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov  WHERE cod_producto =  "'.$cod_producto.'"
    order by detalle_movimiento.id');

  $producto = $cod_producto;

  return view('historialProducto',compact('movimiento'))->with('producto',$producto);
}


public function productoMovimientoPDF($cod_producto){

  $movimiento = DB::select('SELECT nro_documento_mov ,movimiento.tipo_documento, cod_producto , nombre_producto , detalle_movimiento.tipo , detalle_movimiento.fecha, detalle_movimiento.cantidad , detalle_movimiento.usuario , movimiento.estado FROM detalle_movimiento join movimiento on movimiento.num_documento = detalle_movimiento.nro_documento_mov WHERE cod_producto =  "'.$cod_producto.'"
    order by detalle_movimiento.id');


  $data = [
    'movimiento' => $movimiento
];

$pdf = PDF::loadView('historialProductoPDF',$data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');


return $pdf->download('archivo-pdf.pdf');
}


public function InventarioBodegaPDF($cod_bodega){

   if($cod_bodega == 'TODAS LAS BODEGAS')
   {
    $producto = DB::select('SELECT cod_producto , nombre_producto , TRUNCATE(AVG(neto),0) as precio ,nombre_bodega,  sum(cantidad) as stock FROM detalle_movimiento join movimiento on detalle_movimiento.nro_documento_mov = movimiento.num_documento join bodega on movimiento.cod_bodega = bodega.codigo_bodega 
        WHERE estado = "DISPONIBLE"
        GROUP by cod_producto , nombre_producto , nombre_bodega ');
}else{
    $producto = DB::select('SELECT cod_producto , nombre_producto , TRUNCATE(AVG(neto),0) as precio ,nombre_bodega,  sum(cantidad) as stock FROM detalle_movimiento join movimiento on detalle_movimiento.nro_documento_mov = movimiento.num_documento join bodega on movimiento.cod_bodega = bodega.codigo_bodega 
        WHERE cod_bodega="'.$cod_bodega.'" and estado="DISPONIBLE"
        GROUP by cod_producto , nombre_producto , nombre_bodega ');
}


$data = [
    'producto' => $producto
];

$pdf = PDF::loadView('productoStockPDF',$data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');


return $pdf->download('Stock-bodega.pdf');
}




}