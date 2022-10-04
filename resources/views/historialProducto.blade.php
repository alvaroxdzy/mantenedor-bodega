@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h4>Listado de productos</h4>



  <table id="tabla-historial" class="table dataTable no-footer dtr-inline collapsed">
    <thead class="thead-light">
      <tr>
        <th>tipo documento</th> 
        <th>nro documento</th>
        <th>identificacion producto</th>
        <th>tipo</th>  
        <th>fecha</th>  
        <th>cantidad</th>        

      </tr>
    </thead>
    <tbody>
      @foreach($movimiento as $movimientos) 
      <tr>
        <td>{{$movimientos->tipo_documento}}</td>
        <td>{{$movimientos->nro_documento_mov}}</td>
        <td>{{$movimientos->cod_producto}} {{$movimientos->nombre_producto}}</td>
        <td>{{$movimientos->tipo}}</td>
        <td>{{$movimientos->fecha}}</td>
        <td>{{$movimientos->cantidad}}</td>

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
