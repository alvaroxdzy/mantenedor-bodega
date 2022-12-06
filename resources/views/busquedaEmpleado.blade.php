@extends('layouts.app')

@section('content')

<div  class="container"> 
  <h5 style="text-align:center;">LISTADO DE EMPLEADOS</h5>
  <a href="crear-empleado" id="btn-crear" class="btn btn-primary btn-sm" role="button">Crear Empleado</a>
  <table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped">

    <thead>
      <tr>
        <th>Rut</th>
        <th>Nombres</th>
        <th>Cargo</th>
      </tr>
    </thead>
    <tbody>
      @foreach($empleado as $empleados) 
      <tr class='clickable-row' data-href="modificar-empleado/{{$empleados->rut}}">
       <td><a href="modificar-empleado/{{$empleados->rut}}">{{$empleados->rut}}</a> </td>
       <td><a href="modificar-empleado/{{$empleados->rut}}">{{$empleados->nombres}}</a> </td>
       <td><a href="modificar-empleado/{{$empleados->rut}}">{{$empleados->cargo}}</a></td>
     </tr>
     @endforeach
   </tbody>
 </table>  
</div>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
      window.location = $(this).data("href");
    });
  });
</script>

<script>
 var dataTable = new DataTable("#myTable", {
  perPage: 50,
  sortable: true,
  fixedColumns: true,
  perPageSelect: [50, 100],
  labels: {
    placeholder: "Buscar..",
    perPage: "{select}     Registros por pagina",
    noRows: "No se encontraron registros",
    info: "Mostrando registros del {start} hasta el {end} de un total de {rows} registros",
  }

});
</script>

<style type="text/css">
  #btn-crear{
    padding: 0.2rem .3rem;
    font-size: 0.9rem;
    margin-bottom: 10px;
  }

  .table > :not(caption) > * > * {
    padding: .1rem .1rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 0.5px;
    border-color: #3c3c3c;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    border: 1px solid #3c3c3c;
  }
  a {
    text-decoration: none;
    color: black;
  }

</style>


@endsection
