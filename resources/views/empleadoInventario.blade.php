@extends('layouts.app')

@section('content')



<div  class="container"> 

 <div class="card-header">
  <div class="row">
   <h3>PRODUCTOS ENTREGADOS POR EMPLEADO</h3>
 </div>
 <div class="row">
  <div class="mb-1 col-sm 5 d-flex justify-content-end">
    <a style="margin-top:-40px" class="btn btn-primary" id="generar-pdf">Convertir a PDF</a>
  </div>

</div>
</div>

<table id="myTable" class="table table-sm table-striped  " style="width:100%;" >
  <thead >
    <tr>
      <th>Rut</th>
      <th>Nombres </th>
      <th>Productos\Recibidos</th> 
    </tr>
  </thead>
  <tbody id="trTable">
    @foreach($inventarioEmpleado as $inventarioEmpleados) 
    <tr class='clickable-row' data-href="/historial-empleado/{{$inventarioEmpleados->rut}}">
      <td><a style="color:black " href="/historial-empleado/{{$inventarioEmpleados->rut}}">{{$inventarioEmpleados->rut}}</a></td>
      <td><a style="color:black " href="/historial-empleado/{{$inventarioEmpleados->rut}}">{{$inventarioEmpleados->nombres}}</a> </td>
      <td>{{intval($inventarioEmpleados->productos_entregados)}} </td>
    </tr>
    @endforeach
  </tbody>
</table>  

<div id="error"> </div>
@if(session()->has('message'))
<div class="alert alert-success">
  {{ session()->get('message') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
  {{ session()->get('error') }}
</div>
@endif

<script type="text/javascript">

 $(document).ready(function(){
  $('#generar-pdf').on('click',function(){

    $cod_bodega = $("#seleccionar-bodega option:selected").val();
    location.href = "inventario-empleado-pdf/"+$cod_bodega;

  })
});

</script>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
      window.location = $(this).data("href");
    });
  });
</script>

<script>
 var dataTable = new DataTable("#myTable", {
  perPage: 25,
  sortable: true,
  fixedColumns: false,
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
  #myTable tbody tr:hover {
    background-color: #f3f3f3;
    cursor:pointer;
  }

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