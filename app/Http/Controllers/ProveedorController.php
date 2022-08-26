<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

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
           return redirect()->back()->with('error', 'ERROR RUT PROVEEDOR EXISTENTE');
       }
       $proveedor =new Proveedor();
       $proveedor->rut_proveedor=$request->rut_proveedor; 
       $proveedor->dig_rut_prov=$request->dig_rut_prov; 
       $proveedor->razon_social=$request->razon_social; 
       $proveedor->giro=$request->giro; 
       $proveedor->direccion_prov=$request->direccion_prov;
       $proveedor->comuna_prov=$request->comuna_prov;
       $proveedor->ciudad_prov=$request->ciudad_prov;
       $proveedor->banco=$request->banco;
       $proveedor->tipo_cuenta=$request->tipo_cuenta;
       $proveedor->n_cta_prov=$request->n_cta_prov;    
       $proveedor->telefono_prov=$request->telefono_prov;   
       $proveedor->save();

         
       return redirect()->back()->with('message', 'Proveedor creado correctamente');
   }

    public function edit($id)
    {
        $proveedor = Proveedor::where('rut_proveedor',$id)->first();
        return view('modificarProveedor')->with('proveedor',$proveedor) ;
    }

    public function update(Request $request)  
    {
       $proveedor =Proveedor::find($request->id);
       $proveedor->rut_proveedor=$request->rut_proveedor; 
       $proveedor->dig_rut_prov=$request->dig_rut_prov; 
       $proveedor->razon_social=$request->razon_social; 
       $proveedor->giro=$request->giro; 
       $proveedor->direccion_prov=$request->direccion_prov;
       $proveedor->comuna_prov=$request->comuna_prov;
       $proveedor->ciudad_prov=$request->ciudad_prov;
       $proveedor->banco=$request->banco;
       $proveedor->tipo_cuenta=$request->tipo_cuenta;
       $proveedor->n_cta_prov=$request->n_cta_prov;   
       $proveedor->telefono_prov=$request->telefono_prov;
       $proveedor->save();
       return redirect(route('proveedor.search'));
   }

    public function search()
    {
        if(isset($_GET['query'])){
            $proveedor_search = $_GET['query'];
            $proveedores = Proveedor::where('rut_proveedor','LIKE','%'.$proveedor_search.'%')
            ->orWhere('rut_proveedor','LIKE','%'.$proveedor_search.'%')
            ->orWhere('dig_rut_prov','LIKE','%'.$proveedor_search.'%')
            ->orWhere('razon_social','LIKE','%'.$proveedor_search.'%')
            ->orWhere('giro','LIKE','%'.$proveedor_search.'%')
            ->orWhere('direccion_prov','LIKE','%'.$proveedor_search.'%')
            ->orWhere('comuna_prov','LIKE','%'.$proveedor_search.'%')
            ->orWhere('ciudad_prov','LIKE','%'.$proveedor_search.'%')
            ->orWhere('banco','LIKE','%'.$proveedor_search.'%')
            ->orWhere('tipo_cuenta','LIKE','%'.$proveedor_search.'%')
            ->orWhere('n_cta_prov','LIKE','%'.$proveedor_search.'%')  
            ->orWhere('telefono_prov','LIKE','%'.$proveedor_search.'%')          
            ->get();
        } else
        {
            $proveedores=Proveedor::all();
        }
        return view('busquedaProveedor',compact('proveedores'));
    }
}
