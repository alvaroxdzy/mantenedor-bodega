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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$bodega=new Bodega();


        //$alvaro='bodegalvaro';
        //$bodega->nombre= $alvaro;
        //$bodega->save();
        //return view('index')->with('alvaron',$alvaro) ;
    }

    public function consulta()
    {
        $bodega=Bodega::get() ;
        
        return $bodega;
    }

    public function listado()
    {
      //  $bodega=Bodega::all() ;

      //  return view('ListadoBodegas')->with('bodegas',$bodega) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crearBodega');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bodegaprueba = Bodega::where('ID_Bodega',$request->codigo_bodega)->first();
       if ($bodegaprueba) {
         return redirect()->back()->with('error', 'ERROR CODIGO BODEGA EXISTENTE');

     }


     $bodega =new Bodega();
     $bodega->ID_Bodega=$request->codigo_bodega; 
     $bodega->Nombre_Bodega=$request->nombre_bodega; 
     $bodega->Direccion_Bodega=$request->direccion_bodega; 
     $bodega->Comuna_Bodega=$request->sucursal_bodega; 
     $bodega->Telefono_Bodega=$request->telefono_bodega; 
     $bodega->save();

          //  if ($bodega->save()) {
     return redirect()->back()->with('message', 'Bodega creada correctamente');
//
          // } else {
          //     return redirect()->back()->with('error', 'ERROR ');
          // } 


 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search()
    {
        if(isset($_GET['query'])){
            $search_text = $_GET['query'];
            $bodegas = Bodega::where('Nombre_Bodega','LIKE','%'.$search_text.'%')
            ->orWhere('ID_Bodega','LIKE','%'.$search_text.'%')
            ->orWhere('Direccion_bodega','LIKE','%'.$search_text.'%')
            ->orWhere('Comuna_bodega','LIKE','%'.$search_text.'%')
            ->orWhere('Telefono_bodega','LIKE','%'.$search_text.'%')
            ->get();

        } else
        {

            $bodegas=Bodega::all();
        }



        return view('busquedaBodega',compact('bodegas'));
    }

}
