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

     $productoprueba = Producto::where('codigo_producto',$request->codigo_producto)
     ->where('cod_bod_producto',$request->cod_bod_producto)->first();
     if ($productoprueba) {
        $productoUpdate = DB::table('producto')
        ->where('codigo_producto',$request->codigo_producto)
        ->where('cod_bod_producto',$request->cod_bod_producto)
        ->update(['nombre_producto' => $request->nombre_producto,
          'observacion_producto' => $request->observacion_producto]);

        return redirect()->back()->with('message', 'producto actualizado');
    } else {
     $producto =new Producto();
     $producto->codigo_producto=$request->codigo_producto; 
     $producto->nombre_producto=$request->nombre_producto; 
     $producto->observacion_producto=$request->observacion_producto; 
     $producto->cod_bod_producto=$request->cod_bod_producto; 
     $producto->usuario=$request->usuario; 
     $producto->save();

     return redirect()->back()->with('message', 'producto creado correctamente');
 }

}

public function search()
{

    $productos=Producto::join('bodega','producto.cod_bod_producto', '=','bodega.codigo_bodega')->select('producto.codigo_producto','producto.nombre_producto', 'producto.observacion_producto' , 'bodega.nombre_bodega as nombre_bodega' , 'bodega.codigo_bodega as cod_bodega')->get();

    return view('busquedaProducto',compact('productos'));
}

public function traerProducto(Request $request) 
{
    $cod_bodega = $request->cod_bodega;
    $cod_producto = $request->cod_producto;

    $producto = Producto::where('cod_bod_producto',$cod_bodega)
    ->where('codigo_producto',$cod_producto)->first();
    return $producto;
}

public function edit($cod_producto,$cod_bodega)
{
   $producto = Producto::join('bodega','producto.cod_bod_producto', '=','bodega.codigo_bodega')->where('cod_bod_producto',$cod_bodega)
   ->where('codigo_producto',$cod_producto)->first();

   $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get();
   return view('modificarproducto')->with('producto',$producto)->with('bodega',$bodega);


}

public function update(Request $request)  
{
 $productoUpdate = DB::table('producto')
 ->where('codigo_producto',$request->codigo_producto)
 ->where('cod_bod_producto',$request->cod_bod_producto)
 ->update(['nombre_producto' => $request->nombre_producto,
  'observacion_producto' => $request->observacion_producto]);
 return redirect(route('producto.search'));
}

public function inventario()
{
    $bodega = Bodega::select('codigo_bodega','nombre_bodega')->get()->unique('codigo_bodega','nombre_bodega');

    $producto = DetalleMovimiento::join('movimiento','detalle_movimiento.nro_documento_mov','movimiento.num_documento')
    ->join('bodega','movimiento.cod_bodega','bodega.codigo_bodega')
    ->select('cod_producto','nombre_producto','nombre_bodega','cod_bodega', DB::raw('SUM(detalle_movimiento.cantidad) as stock'),DB::raw('avg(detalle_movimiento.neto) as precio'))
    ->groupBy('detalle_movimiento.cod_producto' , 'detalle_movimiento.nombre_producto' , 'bodega.nombre_bodega','cod_bodega')
    ->get();

    return view('productoStock')->with('bodega',$bodega)->with('producto',$producto);
}


public function filtrarInventario(Request $request){
    $cod_bodega=$request->cod_bodega;
    $fecha_desde=$request->fecha_desde;
    $fecha_hasta=$request->fecha_hasta;


    if($cod_bodega == 'TODAS LAS BODEGAS')
    {
      $producto = DetalleMovimiento::join('movimiento','detalle_movimiento.nro_documento_mov','movimiento.num_documento')
      ->join('bodega','movimiento.cod_bodega','bodega.codigo_bodega')
      ->select('cod_producto','nombre_producto','nombre_bodega','cod_bodega', DB::raw('SUM(detalle_movimiento.cantidad) as cantidad'),DB::raw('avg(detalle_movimiento.neto) as neto'))
      ->groupBy('detalle_movimiento.cod_producto' , 'detalle_movimiento.nombre_producto' , 'bodega.nombre_bodega','cod_bodega')
      ->get();
  }else{
    $producto = DetalleMovimiento::join('movimiento','detalle_movimiento.nro_documento_mov','movimiento.num_documento')
      ->join('bodega','movimiento.cod_bodega','bodega.codigo_bodega')
      ->select('cod_producto','nombre_producto','nombre_bodega','cod_bodega', DB::raw('SUM(detalle_movimiento.cantidad) as cantidad'),DB::raw('avg(detalle_movimiento.neto) as neto'))
      ->where('cod_bodega',$cod_bodega)
      ->where('estado','DISPONIBLE')
      ->groupBy('detalle_movimiento.cod_producto' , 'detalle_movimiento.nombre_producto' , 'bodega.nombre_bodega','cod_bodega')
      ->get();
}

return $producto;
}

public function productoHistorial($cod_producto,$cod_bodega){

  $movimiento = Movimiento::join('detalle_movimiento','detalle_movimiento.nro_documento_mov','movimiento.num_documento')
  ->select('detalle_movimiento.nro_documento_mov','movimiento.tipo_documento','cod_producto','nombre_producto','detalle_movimiento.tipo','detalle_movimiento.fecha','detalle_movimiento.cantidad','detalle_movimiento.usuario','movimiento.estado')
  ->where('cod_producto',$cod_producto)
  ->where('cod_bodega',$cod_bodega)
  ->orderBy('id')->get();

  $producto = Producto::where('codigo_producto',$cod_producto)
  ->where('cod_bod_producto',$cod_bodega)->first();
  $bodega = Bodega::where('codigo_bodega',$cod_bodega)->first();

  return view('historialProducto')->with('movimiento',$movimiento)->with('producto',$producto)->with('bodega',$bodega);
}


public function productoMovimientoPDF($cod_producto,$cod_bodega){

  $movimiento = Movimiento::join('detalle_movimiento','detalle_movimiento.nro_documento_mov','movimiento.num_documento')
  ->select('detalle_movimiento.nro_documento_mov','movimiento.tipo_documento','cod_producto','nombre_producto','detalle_movimiento.tipo','detalle_movimiento.fecha','detalle_movimiento.cantidad','detalle_movimiento.usuario','movimiento.estado')
  ->where('cod_producto',$cod_producto)
  ->where('cod_bodega',$cod_bodega)
  ->orderBy('id')->get();

  $producto = Producto::where('codigo_producto',$cod_producto)
  ->where('cod_bod_producto',$cod_bodega)
  ->first();
  $bodega = Bodega::where('codigo_bodega',$cod_bodega)->first();

  $data = [
    'movimiento' => $movimiento,
    'producto' => $producto,
    'bodega' => $bodega
];

$pdf = PDF::loadView('historialProductoPDF',$data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');


return $pdf->download('archivo-pdf.pdf');

}


public function InventarioBodegaPDF($cod_bodega){

 if($cod_bodega == 'TODAS LAS BODEGAS')
 {
  $producto = DetalleMovimiento::join('movimiento','detalle_movimiento.nro_documento_mov','movimiento.num_documento')
  ->join('bodega','movimiento.cod_bodega','bodega.codigo_bodega')
  ->select('cod_producto','nombre_producto','nombre_bodega','cod_bodega', DB::raw('SUM(detalle_movimiento.cantidad) as stock'),DB::raw('round(avg(detalle_movimiento.neto),0) as precio'))
  ->groupBy('detalle_movimiento.cod_producto' , 'detalle_movimiento.nombre_producto' , 'bodega.nombre_bodega','cod_bodega')
  ->get();

}else{

    $producto = DetalleMovimiento::join('movimiento','detalle_movimiento.nro_documento_mov','movimiento.num_documento')
      ->join('bodega','movimiento.cod_bodega','bodega.codigo_bodega')
      ->select('cod_producto','nombre_producto','nombre_bodega','cod_bodega', DB::raw('SUM(detalle_movimiento.cantidad) as stock'),DB::raw('round(avg(detalle_movimiento.neto),0) as precio'))
      ->where('estado','DISPONIBLE')
      ->where('cod_bodega',$cod_bodega)
      ->groupBy('detalle_movimiento.cod_producto' , 'detalle_movimiento.nombre_producto' , 'bodega.nombre_bodega','cod_bodega')
      ->get();
}
  
$data = [
    'producto' => $producto
];

$pdf = PDF::loadView('productoStockPDF',$data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');


return $pdf->download('Stock-bodega.pdf');
}




}