@extends('layouts.app')

@section('content')



<div  class="container"> 
  <br/>
  <h4>Listado de productos</h4>
  <div id="div-buscar-bodega" class=""> 
   <form class="form-text-input" type="get" action="{{ url('/busqueda-productos') }}">

     <input class="form-text-input" placeholder=" 🔍︎ productos" type="text" name="query">
     <button class="btn btn-outline-primary btn-sm" type="submit">BUSCAR</button>
     <a href="crear-producto" class="btn btn-outline-primary btn-sm" role="button">CREAR</a>

   </form>
 </div>
 <div class="row"> 
   <div class="clod-md-4"> </div>
   <div class="clod-md-6"> 
     <div class="row">   
       @if(@Auth::user()->hasRole('colaborador'))
       <table  class="table dataTable no-footer dtr-inline collapsed">
        <tr>
          <th>Codigo</th>
          <th>Producto</th>
          <th>Observación</th>
          <th>Bodega</th>       
        </tr>
        @foreach($productos as $producto) 
        <tr>
          <td> {{$producto->codigo_producto}} </td>
          <td>{{$producto->nombre_producto}}</td>
          <td>{{$producto->observacion_producto}}</td>
          <td>{{$producto->cod_bod_producto}}</td>
        </tr>
        @endforeach
      </table>  
      @endif
    </div> 
  </div> 
</div> 
</div>      
</div>  


@endsection
