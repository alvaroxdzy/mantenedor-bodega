@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h4>Listado de bodegas</h4>
  <div id="div-buscar-bodega" class=""> 
   <form class="form-text-input" type="get">

     <a href="crear-bodega" class="btn btn-outline-primary btn-sm" role="button">CREAR</a>

   </form>
 </div>
 <div class="row"> 
   <div class="clod-md-4"> </div>
   <div class="clod-md-6"> 
     <div class="row">   
       @if(@Auth::user()->hasRole('colaborador'))
       <table id="myTable" class="table dataTable no-footer dtr-inline collapsed">

        <thead>
          <tr>
            <th>Codigo</th>
            <th>Bodega</th>
            <th>Dirección</th>
            <th>Comuna</th>
            <th>Telefono</th>
            <th>Gestionar</th>        
          </tr>
        </thead>
        <tbody>
          @foreach($bodegas as $bodega) 
          <tr>
            <td> {{$bodega->codigo_bodega}} </td>
            <td>{{$bodega->nombre_bodega}}</td>
            <td>{{$bodega->direccion_bodega}}</td>
            <td>{{$bodega->comuna_bodega}}</td>
            <td>{{$bodega->telefono_bodega}}</td>
            <td><a class="btn btn-outline-primary btn-sm" href="modificar-bodega/{{$bodega->codigo_bodega}}"> Modificar </a></td>
          </tr>
          @endforeach
        </tbody>
      </table>  
      <script>
       var dataTable = new DataTable("#myTable", {
        perPage: 10,
        sortable: true,
        fixedColumns: true,
        perPageSelect: [10, 25, 50, 100],
        labels: {
          placeholder: "Buscar..",
          perPage: "{select}     Registros por pagina",
          noRows: "No se encontraron registros",
          info: "Mostrando registros del {start} hasta el {end} de un total de {rows} registros",
        }

      });
    </script>
    @endif
  </div> 
</div> 
</div> 
</div>      
</div>  


@endsection
