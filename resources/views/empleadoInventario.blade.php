@extends('layouts.app')

@section('content')



<div  class="container"> 

 <div class="card-header">
  <div class="row">
     <h3>Entrega de productos por empleado</h3>
   </div>
<div class="row">
 <div class=" mb-3 col-md-3"> 
    <select class="form-select form-select-sm " id="seleccionar-bodega">
      <option value="TODAS LAS BODEGAS">TODAS LAS BODEGAS</option>
      <option value="003">BODEGA PREVENCION</option>
    </select>

  </div>

  <div class="mb-2 col-md-4"> 
    <input type="button" class="btn-outline-primary btn-sm" id="btn-filtrar" value="Buscar"> 
  </div>
  <div class="mb-1 col-sm 5 d-flex justify-content-end">
    <a class="btn btn-primary" id="generar-pdf"  >Convertir a PDF</a>
  </div>

</div>
</div>

<table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped">
  <thead class="thead-light">
    <tr>
      <th>rut</th>
      <th>nombres</th>
      <th>productos/entregados</th> 
      <th>bodega</th>
    </tr>
  </thead>
  <tbody id="trTable">
    @foreach($inventarioEmpleado as $inventarioEmpleados) 
    <tr>
      <td><a class="nav-link" style="color:black " href="/historial-empleado/{{$inventarioEmpleados->rut}}" id="btn-revisar" type="button">{{$inventarioEmpleados->rut}}</a></td>
      <td><a class="nav-link" style="color:black " href="/historial-empleado/{{$inventarioEmpleados->rut}}" id="btn-revisar" type="button">{{$inventarioEmpleados->nombres}}</a> </td>
      <td>{{intval($inventarioEmpleados->productos_entregados)}} </td>
      <td>{{$inventarioEmpleados->nombre_bodega}}</td>

    </tr>
    @endforeach
  </tbody>
</table>  


<script type="text/javascript">

 $(document).ready(function(){
        $('#generar-pdf').on('click',function(){

$cod_bodega = $("#seleccionar-bodega option:selected").val();
 location.href = "inventario-empleado-pdf/"+$cod_bodega;

})
});

  </script>


<script>
 var dataTable = new DataTable("#myTable", {
  perPage: 25,
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

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).on('click','#btn-filtrar',function(){

    $('#myTable').DataTable().clear().destroy();

    var codigo_bodega=$('#seleccionar-bodega option:selected').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/filtrar-empleados", //url guarda la ruta hacia donde se hace la peticion
         data:{
           "cod_bodega":codigo_bodega,
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
          
          //$('#trTable').empty();
          data.forEach(function(detalle) {

              $('#trTable').append('<tr>'+
                                  '<td><a class="nav-link" style="color:black " href="/historial-empleado/{{$inventarioEmpleados->rut}}" id="btn-revisar" type="button">'+detalle.rut+'</a></td>'+
                                  '<td><a class="nav-link" style="color:black " href="/historial-empleado/{{$inventarioEmpleados->rut}}" id="btn-revisar" type="button"> '+detalle.nombres+'</a></td>'+
                                  '<td style="width:25%" >'+detalle.productos_entregados+'</td>'+
                                  '<td>'+detalle.nombre_bodega+'</td>'+
                                  '</tr>');

          });

        },
      });

  });

</script>



@endsection