@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5 style="text-align:center;">LISTADO DE BODEGAS</h5>
  <a href="crear-bodega" id="btn-crear" class="btn btn-primary btn-sm" role="button">Crear Bodega</a>
  <table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped">
    <thead>
      <tr>
        <th onclick="sortTable(0)">Codigo</th>
        <th onclick="sortTable(1)">Bodega</th>
        <th onclick="sortTable(2)">Dirección</th>
        <th onclick="sortTable(3)">Comuna</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bodegas as $bodega) 
      <tr>
        <td> {{$bodega->codigo_bodega}} </td>
        <td>{{$bodega->nombre_bodega}}</td>
        <td>{{$bodega->direccion_bodega}}</td>
        <td>{{$bodega->comuna_bodega}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>  

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

    th:hover {
      cursor: pointer;
      background-color: #f3f3f3;
    }

    #btn-crear{
      padding: 0.2rem .3rem;
      font-size: 0.9rem;
     margin-bottom: 10px;
    }

  </style>

  @endsection
