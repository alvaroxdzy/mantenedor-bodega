@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5 style="text-align:center;">LISTADO DE VEHICULOS</h5>
  <a href="crear-vehiculo" id="btn-crear" class="btn btn-primary btn-sm" role="button">Crear Vehiculos</a>
  <table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped">
    <thead>
      <tr>
        <th>Tipo</th>
        <th>Marca</th>
        <th style="width:250px">Modelo</th>
        <th>Patente</th>
        <th>Año</th>
      </tr>
    </thead>
    <tbody>
      @foreach($vehiculo as $vehiculos) 
      <tr>
        <td><a href="/modificar-vehiculo/{{$vehiculos->patente}}">{{$vehiculos->tipo_equipo}}</a></td>
        <td><a href="/modificar-vehiculo/{{$vehiculos->patente}}">{{$vehiculos->marca}}</a></td>
        <td style="width:250px"><a href="/modificar-vehiculo/{{$vehiculos->patente}}">{{$vehiculos->modelo}}</a></td>
        <td><a href="/modificar-vehiculo/{{$vehiculos->patente}}">{{$vehiculos->patente}}</a></td>
        <td><a href="/modificar-vehiculo/{{$vehiculos->patente}}">{{$vehiculos->anio}}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>  
</div>
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
  .table > :not(caption) > * > * {
    padding: .1rem .1rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 0.5px;
    border-color: #3c3c3c;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    border: 1px solid #3c3c3c;
  }

  th {
    cursor: pointer;
  }

  #btn-crear{
    padding: 0.2rem .3rem;
    font-size: 0.9rem;
    margin-bottom: 10px;
  }
  a {
    text-decoration: none;
    color: black;
  }
</style>


@endsection
