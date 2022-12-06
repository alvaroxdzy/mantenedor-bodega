<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use DB;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function consultaProveedor()
    {
        $proveedor=Proveedor::get() ;
        return $proveedor;
    }

    public function create()
    {
        return view('crearProveedor');
    }

    
    public function store(Request $request)
    {
        $proveedorcheck = Proveedor::where('rut_proveedor',$request->rut_proveedor)->first();
        if ($proveedorcheck) {

            $proveedorUpdate = DB::table('proveedor')
            ->where('rut_proveedor',$request->rut_proveedor)
            ->update(['razon_social' => $request->razon_social,
              'giro' => $request->giro,
              'direccion_prov' => $request->direccion_prov]);

            return redirect()->back()->with('message', 'Proveedor actualizado correctamente');
        }
        $proveedor =new Proveedor();
        $proveedor->rut_proveedor=$request->rut_proveedor; 
        $proveedor->razon_social=$request->razon_social; 
        $proveedor->giro=$request->giro; 
        $proveedor->direccion_prov=$request->direccion_prov;


        $proveedor->save();


        return redirect()->back()->with('message', 'Proveedor creado correctamente');
    }

    public function traerProveedor(Request $request)
    {
      $rut_proveedor = $request->rut_proveedor;

      $proveedor = Proveedor::where('rut_proveedor',$rut_proveedor)->first();
      return $proveedor;
  }

  public function edit($rut)
  {
    $proveedor = Proveedor::where('rut_proveedor',$rut)->first();
    return view('modificarProveedor')->with('proveedor',$proveedor) ;
}

public function update(Request $request)  
{
    $proveedor =Proveedor::find($request->id);
    $proveedor->rut_proveedor=$request->rut_proveedor; 
    $proveedor->razon_social=$request->razon_social; 
    $proveedor->giro=$request->giro; 
    $proveedor->direccion_prov=$request->direccion_prov;
    $proveedor->save();
    return redirect(route('proveedor.search'));
}

public function search(){


    $proveedores=Proveedor::all();
    return view('busquedaProveedor',compact('proveedores'));
}

public function destroy($id)
{
    $proveedor = Proveedor::find($id);
    $proveedor->delete();
    return redirect(route('proveedor.search'));

}    

public function modal(){
    $proveedor=Proveedor::all();
    return view('modelProveedor',compact('proveedor'));
}


}
