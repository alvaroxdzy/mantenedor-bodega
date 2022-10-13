@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5 style="text-align:center">DETALLE MOVIMIENTO  </h5>

  <h6>TIPO DOCUMENTO : {{$movimiento->tipo_documento}} </h6>
  <h6>NRO DOCUMENTO : {{$movimiento->num_documento}} </h6>
  <h6>FECHA : {{$movimiento->fecha}} </h6>
  <h6>BODEGA : {{$movimiento->nombre_bodega}} </h6>
  <table id="tabla-historial" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th>cod_producto</th>
        <th>nombre_producto</th> 
        <th >tipo</th>
        <th>cantidad</th>  
        <th>neto</th>
        <th>total</th>     
        <th>rut</th>    
        <th>patente</th>      

      </tr>
    </thead>
    <tbody>
      @foreach($detalleMovimiento as $detalleMovimientos) 
      <tr>
        <td>{{$detalleMovimientos->cod_producto}}</td>
        <td>{{$detalleMovimientos->nombre_producto}}</td>
        <td>{{$detalleMovimientos->tipo}} </td>
        <td>{{$detalleMovimientos->cantidad}}</td>
        <td>${{$detalleMovimientos->neto}}</td>
        <td>${{$detalleMovimientos->total}}</td>
        <td>{{$detalleMovimientos->rut}}</td>
        <td>{{$detalleMovimientos->patente}} </td>



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
