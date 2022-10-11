@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5>HISTORIAL EMPLEADO </h5>
  <h5>{{$trabajador->nombres}} {{$trabajador->rut}} </h5>

  <table id="tabla-historial" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
    <thead class="thead-light">
      <tr>
        <th>Documento</th>
        <th>Numero</th> 
        <th >Codigo/Producto</th>
        <th>Producto</th>  
        <th >Fecha</th>
        <th>Cantidad</th>  


      </tr>
    </thead>
    <tbody>
      @foreach($empleado as $empleados) 
      <tr>
        <td>{{$empleados->tipo_documento}}</td>
        <td>{{$empleados->nro_documento_mov}}</td>
        <td >{{$empleados->cod_producto}}</td>
        <td>{{$empleados->nombre_producto}}</td>
        <td>{{$empleados->fecha}}</td>
        <td style="text-align:end;">{{$empleados->cantidad}}</td>


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
  <a class="btn btn-primary" href="/historial-empleado-pdf/{{$trabajador->rut}}">Convertir a PDF</a>
</div>
</div> 




@endsection
