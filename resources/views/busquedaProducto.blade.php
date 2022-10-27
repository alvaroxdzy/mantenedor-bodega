@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h4>Listado de productos</h4>
  <div id="div-buscar-bodega" class=""> 

  </div>
  <div class="row"> 
   <div class="clod-md-4"> </div>
   <div class="clod-md-6"> 
     <div class="row">   

       <table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped">
        <thead class="thead-light">
          <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Observación</th>
            <th>Bodega</th>        
          </tr>
        </thead>
        <tbody>
          @foreach($productos as $producto) 
          <tr>

            <td><a style="color:black " href="/modificar-producto/{{$producto->codigo_producto}}/{{$producto->cod_bodega}}">{{$producto->codigo_producto}}</a> </td>          
            <td><a style="color:black " href="/modificar-producto/{{$producto->codigo_producto}}/{{$producto->cod_bodega}}">{{$producto->nombre_producto}}</a> </td>
            <td>{{$producto->observacion_producto}}</td>
            <td>{{$producto->nombre_bodega}}</td>
            <td style="visibility:hidden;"> {{$producto->cod_bodega}} </td>
          </tr>
          @endforeach
        </tbody>
      </table> 
      <form class="form-text-input" type="get">
       <a href="crear-producto" class="btn btn-outline-primary btn-sm" role="button">AGREGAR PRODUCTO</a>

     </form> 

     <script>
       var dataTable = new DataTable("#myTable", {
        perPage: 10,
        sortable: true,
        fixedColumns: true,
        perPageSelect: [10, 25, 50, 100],
        info: false,
        labels: {
          placeholder: "Buscar..",
          perPage: "{select}     Registros por pagina",
          noRows: "No se encontraron registros",
          info: "Mostrando registros del {start} hasta el {end} de un total de {rows} registros",
        }

      });
    </script>
  </div> 
</div> 
</div> 
</div>      
</div>  


@endsection
