@extends('layouts.app')

@section('content')

<div  class="container"> 

 <div class="card-header">
  <div class="row">
     <h3>LISTADO DE PRODUCTOS</h3>
   </div>
<div class="row">
 <div class=" mb-3 col-md-3"> 
    <select class="form-select form-select-sm " id="seleccionar-bodega">
      <option value="TODAS LAS BODEGAS">TODAS LAS BODEGAS</option>
      @foreach($bodega as $nombrebodegas)

      <option value="{{$nombrebodegas->codigo_bodega}}">{{$nombrebodegas->nombre_bodega}} </option>
      @endforeach
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

<table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
  <thead class="thead-light">
    <tr>
      <th>Codigo</th>
      <th>Producto</th>
      <th>Precio/Unitario</th> 
      <th>Stock</th>  
      <th>Bodega</th>
    </tr>
  </thead>
  <tbody id="trTable">
    @foreach($producto as $productos) 
    <tr>
      <td><a style="color:black  "href="/modificar-producto/{{$productos->cod_producto}}/{{$productos->cod_bodega}}">{{$productos->cod_producto}}</a></td>
      <td><a style="color:black  "href="/historial-producto/{{$productos->cod_producto}}/{{$productos->cod_bodega}}">{{$productos->nombre_producto}}</a> </td>
      <td>{{intval($productos->precio)}} </td>
      <td>{{$productos->stock}}</td>

      <td>{{$productos->nombre_bodega}}</td>

    </tr>
    @endforeach
  </tbody>
</table>  






<script type="text/javascript">

 $(document).ready(function(){
        $('#generar-pdf').on('click',function(){

$cod_bodega = $("#seleccionar-bodega option:selected").val();
 location.href = "stock-producto-pdf/"+$cod_bodega;

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

    $('#trTable').empty();

    var codigo_bodega=$('#seleccionar-bodega option:selected').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/filtrar-productos", //url guarda la ruta hacia donde se hace la peticion
         data:{
           "cod_bodega":codigo_bodega,
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
          
          //$('#trTable').empty();
          data.forEach(function(detalle) {
            console.log(detalle);
              $('#trTable').append('<tr>'+
                                  '<td style="width:150px "><a style="color:black" href="/historial-producto/'+detalle.cod_producto+'/'+detalle.cod_bodega+'">'+detalle.cod_producto+'</a></td>'+
                                  '<td><a style="color:black" href="/historial-producto/'+detalle.cod_producto+'/'+detalle.cod_bodega+'">'+detalle.nombre_producto+'</a></td>'+
                                  '<td>'+parseInt(detalle.neto)+'</td>'+
                                  '<td>'+detalle.cantidad+'</td>'+
                                  '<td>'+detalle.nombre_bodega+'</td>'+

                                  '</tr>');

          });

        },
      });

  });

</script>



@endsection