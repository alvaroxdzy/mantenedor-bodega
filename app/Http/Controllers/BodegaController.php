<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;



class BodegaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

    }

    public function consulta()
    {
        $bodega=Bodega::get() ;
        return $bodega;
    }

    public function create()
    {
        return view('crearBodega');
    }

    
    public function store(Request $request)
    {
        $bodegaprueba = Bodega::where('codigo_bodega',$request->codigo_bodega)->first();
        if ($bodegaprueba) {
           return redirect()->back()->with('error', 'ERROR CODIGO BODEGA EXISTENTE');
       }
       $bodega =new Bodega();
       $bodega->codigo_bodega=$request->codigo_bodega; 
       $bodega->nombre_bodega=$request->nombre_bodega; 
       $bodega->direccion_bodega=$request->direccion_bodega; 
       $bodega->comuna_bodega=$request->sucursal_bodega; 
       $bodega->telefono_bodega=$request->telefono_bodega; 
       $bodega->save();

          //  if ($bodega->save()) {
       return redirect()->back()->with('message', 'Bodega creada correctamente');
   }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $bodega = Bodega::where('codigo_bodega',$id)->first();
        return view('modificarbodega')->with('bodega',$bodega) ;
    }

    public function update(Request $request)  
    {
      // $bodegaprueba = Bodega::where('codigo_bodega',$request->codigo_bodega)->first();
      // if ($bodegaprueba) {
      //    return redirect()->back()->with('error', 'ERROR CODIGO BODEGA EXISTENTE');
      //}

       $bodega =Bodega::find($request->id);
       $bodega->codigo_bodega=$request->codigo_bodega; 
       $bodega->nombre_bodega=$request->nombre_bodega; 
       $bodega->direccion_bodega=$request->direccion_bodega; 
       $bodega->comuna_bodega=$request->sucursal_bodega; 
       $bodega->telefono_bodega=$request->telefono_bodega; 
       $bodega->save();
       return redirect(route('bodega.search'));
   }


    public function destroy($id)
    {
        //
    }

    public function search()
    {
        if(isset($_GET['query'])){
            $search_text = $_GET['query'];
            $bodegas = Bodega::where('nombre_bodega','LIKE','%'.$search_text.'%')
            ->orWhere('codigo_bodega','LIKE','%'.$search_text.'%')
            ->orWhere('direccion_bodega','LIKE','%'.$search_text.'%')
            ->orWhere('comuna_bodega','LIKE','%'.$search_text.'%')
            ->orWhere('telefono_bodega','LIKE','%'.$search_text.'%')
            ->get();
        } else
        {
            $bodegas=Bodega::all();
        }
        return view('busquedaBodega',compact('bodegas'));
    }

}
