@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h4>Listado de empleados</h4>
  <div id="div-buscar-bodega" class=""> 
   <form class="form-text-input" type="get">

     <a href="crear-empleado" class="btn btn-outline-primary btn-sm" role="button">CREAR</a>

   </form>
 </div>
 <div class="row"> 
   <div class="clod-md-4"> </div>
   <div class="clod-md-6"> 
     <div class="row">   

       <table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped">

        <thead>
          <tr>
            <th>Rut</th>
            <th>Nombres</th>
            <th>Cargo</th>
            <th>Gestionar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($empleado as $empleados) 
          <tr>
            <td> {{$empleados->rut}} </td>
            <td>{{$empleados->nombres}}</td>
            <td>{{$empleados->cargo}}</td>
             <td id="td-datatable"><a class="btn btn-outline-primary btn-sm" href="modificar-empleado/{{$empleados->rut}}"> Modificar </a></td>
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
