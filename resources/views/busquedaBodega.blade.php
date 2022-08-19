@extends('layouts.app')

@section('content')



<div  class="container"> 
  <br/>
  <h4>Listado de bodegas</h4>
  <div class="row"> 
    <div id="div-buscar-bodega" class="col-xl-12"> 
     <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('/busquedaBodegas') }}">
       <input class="form-control mr-sm-2" type="search" name="query">
       <button class="btn btn-outline-ligth my-2 my-sm-0" type="submit">BUSCAR</button>

     </form>

    </div>

    <div class="clod-md-4"> </div>
    <div class="clod-md-6"> 
     <div class="row">   
       @if(@Auth::user()->hasRole('colaborador'))
       <table  class="table dataTable no-footer dtr-inline collapsed">
        <tr>
          <th>Codigo</th>
          <th>Bodega</th>
          <th>Dirección</th>
          <th>Comuna</th>
          <th>Telefono</th>        
        </tr>
        @foreach($bodegas as $bodega) 
        <tr>
          <td> {{$bodega->ID_Bodega}} </td>
          <td>{{$bodega->Nombre_Bodega}}</td>
          <td>{{$bodega->Direccion_Bodega}}</td>
          <td>{{$bodega->Comuna_Bodega}}</td>
          <td>{{$bodega->Telefono_Bodega}}</td>
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
