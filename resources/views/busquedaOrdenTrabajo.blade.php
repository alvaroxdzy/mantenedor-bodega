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
        <td><a style="color:black " href="/modificar-orden/{{$ots->num_documento}}"> {{$ots->num_documento}}</a></td>

        <td>{{$ots->fecha}}</td>
        <td>{{$ots->patente}}</td>
        <td>{{$ots->nombres}}</td>
        <td>{{$ots->nombre_bodega}}</td>
        <td>{{$ots->usuario}} </td>
      </tr>
      @endforeach
    </tbody>
  </table>  
  <script>
   var dataTable = new DataTable("#tabla-ordenes", {
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




@endsection
