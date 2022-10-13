@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5>REGISTRO DE MOVIMIENTOS </h5>

  <table id="tabla-historial" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th>Numero Documento</th>
        <th>Tipo documento</th> 
        <th >Tipo</th>
        <th>Fecha</th>  
        <th>Bodega</th>
        <th>Estado</th>
        <th>Usuario</th>     

      </tr>
    </thead>
    <tbody>
      @foreach($movimiento as $movimientos) 
      <tr>
        <td><a style="color:black " href="/detalle-movimiento/{{$movimientos->num_documento}}"> {{$movimientos->num_documento}}</a></td>
        <td>{{$movimientos->tipo_documento}}</td>
        <td>{{$movimientos->tipo}}</td>
        <td>{{$movimientos->fecha}}</td>
        <td>{{$movimientos->nombre_bodega}}</td>
        <td>{{$movimientos->estado}} </td>
        <td>{{$movimientos->usuario}} </td>

      </tr>
      @endforeach
    </tbody>
  </table>  
  <script>
   var dataTable = new DataTable("#tabla-historial", {
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
