@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5>ORDENES DE TRABAJO </h5>

  <table id="tabla-ordenes" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th>Numero</th>

        <th>fecha</th>
        <th>patente</th>  
        <th>Solicitante</th>
        <th>bodega</th>
        <th>Usuario</th>     
      </tr>
    </thead>
    <tbody>
      @foreach($ot as $ots) 
      <tr>
         <?php
        $newDate = date("d-m-Y", strtotime($ots->fecha)); 
        ?>
        <td><a style="color:black " href="/modificar-orden/{{$ots->num_documento}}"> {{$ots->num_documento}}</a></td>
        <td><a style="color:black " href="/modificar-orden/{{$ots->num_documento}}"> <?php echo $newDate; ?></a></td>
        <td><a style="color:black " href="/modificar-orden/{{$ots->num_documento}}"> {{$ots->patente}}</a></td>
        <td><a style="color:black " href="/modificar-orden/{{$ots->num_documento}}"> {{$ots->nombres}}</a></td>
        <td><a style="color:black " href="/modificar-orden/{{$ots->num_documento}}"> {{$ots->nombre_bodega}}</a></td>
        <td><a style="color:black " href="/modificar-orden/{{$ots->num_documento}}"> {{$ots->usuario}}</a></td>

      </tr>
      @endforeach
    </tbody>
  </table>  
</div> 


<script>
 var dataTable = new DataTable("#tabla-ordenes", {
  perPage: 50,
  sortable: true,
  fixedColumns: true,
  perPageSelect: [ 50, 100],
  labels: {
    placeholder: "Buscar..",
    perPage: "{select}     Registros por pagina",
    noRows: "No se encontraron registros",
    info: "Mostrando registros del {start} hasta el {end} de un total de {rows} registros",
  }
});
</script>

<style>
  a {
    text-decoration: none;
    color: black;
  }

  .table > :not(caption) > * > * {
    padding: .1rem .1rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 0.5px;
    border-color: #3c3c3c;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    border: 1px solid #3c3c3c;
  }
</style>



@endsection
