@extends('layouts.app')

@section('content')



<div  class="container"> 

  <b>LISTADO DE PRODUCTOS</b>

  <select id="seleccionar-bodega">
    <option>TODAS LAS BODEGAS</option>
    @foreach($bodega as $nombrebodegas)

    <option value="{{$nombrebodegas->codigo_bodega}}">{{$nombrebodegas->nombre_bodega}} </option>
    @endforeach
  </select>

  <h7>fecha desde </h7>
  <input type="date" id="fecha_desde"> 
  <h7>fecha hasta </h7>
  <input type="date" id="fecha_hasta">

  <input type="button" class="btn-outline-primary btn-sm" id="btn-filtrar" value="Filtrar"> 

  <table id="myTable" class="table dataTable no-footer dtr-inline collapsed">
    <thead class="thead-light">
      <tr>
        <th>Codigo</th>
        <th>Producto</th>
        <th >Precio/Unitario</th> 
        <th>Stock</th>  
        <th>Bodega</th>

      </tr>
    </thead>
    <tbody >
      @foreach($producto as $productos) 
      <tr id="myTbody">
        <td><a class="nav-link" style="color:black " href="/historial-producto/{{$productos->cod_producto}}" id="btn-revisar" type="button">{{$productos->cod_producto}}</a></td>
        <td>{{$productos->nombre_producto}}</td>
        <td> {{intval($productos->precio)}} </td>
        <td>{{$productos->stock}}</td>

        <td>{{$productos->nombre_bodega}}</td>

      </tr>
      @endforeach
    </tbody>
  </table>  

  <script>
   var dataTable = new DataTable("#myTable", {
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

    
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


<script type="text/javascript">
  $(document).on('click','#btn-filtrar',function(){
    $('#myTable').DataTable().destroy();

    var codigo_bodega=$('#seleccionar-bodega option:selected').val();
    var fecha_desde=$('#fecha_desde').val();
    var fecha_hasta=$('#fecha_hasta').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/filtrar-productos", //url guarda la ruta hacia donde se hace la peticion
         data:{
           "codigo_bodega":codigo_bodega,
           "fecha_desde":fecha_desde,
           "fecha_hasta":fecha_hasta,
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
          data.forEach(function(detalle) {

            $('#myTbody').append('<td>'+detalle.cod_producto+'</td>');

          });

        },
      });

  });

</script>



@endsection