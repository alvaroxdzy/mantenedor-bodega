@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5>REGISTRO DE MOVIMIENTOS </h5>

  <table id="tabla-historial" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th>Numero</th>
        <th>Documento</th> 
        <th>Tipo</th>
        <th>Fecha</th>  
        <th>Bodega</th>
        <th>Estado</th>
        <th>Usuario</th>     

      </tr>
    </thead>
    <tbody>
      @foreach($movimiento as $movimientos) 
      <tr>
        <?php
        $newDate = date("d-m-Y", strtotime($movimientos->fecha)); 
        ?>
        <td><a style="color:black " href="/detalle-movimiento/{{$movimientos->num_documento}}/{{$movimientos->tipo_documento}}"> {{$movimientos->num_documento}}</a></td>
        <td><a style="color:black " href="/detalle-movimiento/{{$movimientos->num_documento}}/{{$movimientos->tipo_documento}}"> {{$movimientos->tipo_documento}}</a></td>
        <td><a style="color:black " href="/detalle-movimiento/{{$movimientos->num_documento}}/{{$movimientos->tipo_documento}}"> {{$movimientos->tipo}}</a></td>
        <td><a style="color:black " href="/detalle-movimiento/{{$movimientos->num_documento}}/{{$movimientos->tipo_documento}}"> <?php echo $newDate; ?></a></td>
        <td><a style="color:black " href="/detalle-movimiento/{{$movimientos->num_documento}}/{{$movimientos->tipo_documento}}"> {{$movimientos->nombre_bodega}}</a></td>
        <td><a style="color:black " href="/detalle-movimiento/{{$movimientos->num_documento}}/{{$movimientos->tipo_documento}}"> {{$movimientos->estado}}</a></td>
        <td><a style="color:black " href="/detalle-movimiento/{{$movimientos->num_documento}}/{{$movimientos->tipo_documento}}"> {{$movimientos->usuario}}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>  
  <script>
   var dataTable = new DataTable("#tabla-historial", {
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

</div> 




@endsection
