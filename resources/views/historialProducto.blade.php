@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5>HISTORIAL MOVIMIENTOS </h5>

  <h7> {{$bodega->nombre_bodega}}  </h7>
  <br>
  <h7>CODIGO PRODUCTO : {{$producto->codigo_producto}}  </h7>   

  <table id="tabla-historial" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th>Producto</th>
        <th>Documento</th> 
        <th>Tipo</th>  
        <th>Fecha</th>  
        <th >Cantidad</th>     
      </tr>
    </thead>
    <tbody>
      @foreach($movimiento as $movimientos) 
      <tr>
        <td>{{$movimientos->nombre_producto}}</td>
        <td>{{$movimientos->tipo_documento}} : {{$movimientos->nro_documento_mov}}</td>
        <td>{{$movimientos->tipo}}</td>
        <td>{{$movimientos->fecha}}</td>
        <td style="text-align:end;">{{$movimientos->cantidad}}</td>
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
<div class="mb-4 d-flex justify-content-end">
  <a class="btn btn-primary" href="/historial-producto-pdf/{{$producto->codigo_producto}}/{{$bodega->codigo_bodega}}">Convertir a PDF</a>
</div>
</div> 




@endsection
