@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5 style="text-align:center;">LISTADO DE PRODUCTOS</h5>

  <a href="crear-producto" id="btn-crear" class="btn btn-primary  btn-sm" role="button">Crear Producto</a>

  <div class="row">
   <div class=" mb-3 col-md-3"> 
    <select class="form-select form-select-sm " id="seleccionar-bodega">
      @foreach($bodega as $nombrebodegas)
      <option value="{{$nombrebodegas->codigo_bodega}}">{{$nombrebodegas->nombre_bodega}} </option>
      @endforeach
    </select>

  </div>

  <div class="mb-2 col-md-4"> 
    <a id="btn-filtrar" class="btn btn-primary  btn-sm" role="button">Filtrar Productos</a>
  </div>


  <table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width: 100%;">
    <thead class="thead-light">
      <tr>
        <th onclick="sortTable(0)">Codigo</th>
        <th onclick="sortTable(1)">Producto</th>
        <th>Bodega</th>        
      </tr>
    </thead>
    <tbody id="tbody_producto">
      @foreach($productos as $producto) 
      <tr class='clickable-row' data-href="/modificar-producto/{{$producto->codigo_producto}}/{{$producto->cod_bodega}}">

        <td>{{$producto->codigo_producto}} </td>          
        <td>{{$producto->nombre_producto}} </td>
        <td>{{$producto->nombre_bodega}}</td>
      </tr>
      @endforeach
    </tbody>
  </table> 

</div>  


<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
      window.location = $(this).data("href");
    });
  });
</script>



<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).on('click','#btn-filtrar',function(){

    $('#tbody_producto').empty();

    var codigo_bodega=$('#seleccionar-bodega option:selected').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/productos-bodega", //url guarda la ruta hacia donde se hace la peticion
         data:{
           "cod_bodega":codigo_bodega,
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion

          //$('#trTable').empty();
          data.forEach(function(detalle) {
            $('#tbody_producto').append('<tr>'+
              '<td><a href="/modificar-producto/'+detalle.codigo_producto+'/'+detalle.cod_bod_producto+'">'+detalle.codigo_producto+'</a></td>'+
              '<td><a href="/modificar-producto/'+detalle.codigo_producto+'/'+detalle.cod_bod_producto+'">'+detalle.nombre_producto+'</a></td>'+
              '<td><a href="/modificar-producto/'+detalle.codigo_producto+'/'+detalle.cod_bod_producto+'">'+detalle.nombre_bodega+'</a></td>'+
              '</tr>');

          });

        },
      });

  });

</script>

<script>
  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
  //Set the sorting direction to ascending:
    dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
    while (switching) {
    //start by saying: no switching is done:
      switching = false;
      rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
      for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
        shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
            shouldSwitch= true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      //Each time a switch is done, increase this count by 1:
        switchcount ++;      
      } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
</script>

<style type="text/css">
  .table > :not(caption) > * > * {
    padding: .1rem .1rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 0.5px;
    border-color: #3c3c3c;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    border: 1px solid #3c3c3c;
  }

  th {
    cursor: pointer;
  }

  #myTable tbody tr:hover {
    background-color: #f3f3f3;
    cursor:pointer;
  }

  #btn-crear{
    padding: 0.2rem .3rem;
    font-size: 0.9rem;
    margin-bottom: 10px;
  }

  #btn-filtrar{
    padding: 0.2rem .3rem;
    font-size: 0.9rem;
    margin-bottom: 10px;
  }
  a {
    color:black;
    text-decoration: none;
  }

</style>

@endsection
