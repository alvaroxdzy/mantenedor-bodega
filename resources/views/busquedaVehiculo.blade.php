@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h4>Listado de vehiculos</h4>
  <div > 
   <form class="form-text-input" type="get">

     <a href="crear-vehiculo" class="btn btn-outline-primary btn-sm" role="button">CREAR</a>

   </form>
 </div>
 <div class="row"> 
   <div class="clod-md-4"> </div>
   <div class="clod-md-6"> 
     <div class="row">   

       <table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped">

        <thead>
          <tr>

            <th>Tipo camion</th>
            <th>Marca</th>
            <th style="width:250px">Modelo</th>
            <th>Patente</th>
            <th>Año</th>

          </tr>
        </thead>
        <tbody>
          @foreach($vehiculo as $vehiculos) 
          <tr>

            <td><a style="color:black " href="/modificar-vehiculo/{{$vehiculos->patente}}">{{$vehiculos->tipo_equipo}}</a> </td>
            <td>{{$vehiculos->marca}}</td>
            <td style="width:250px">{{$vehiculos->modelo}}</td>
            <td>{{$vehiculos->patente}} </td>
            <td>{{$vehiculos->anio}}</td>
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

  </div> 
</div> 
</div> 
</div>      
</div>  


@endsection
