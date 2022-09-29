@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h4>Listado de productos</h4>
  <div id="div-buscar-bodega" class=""> 
   <form class="form-text-input" type="get">
     <a href="crear-producto" class="btn btn-outline-primary btn-sm" role="button">CREAR</a>

   </form>
 </div>
 <div class="row"> 
   <div class="clod-md-4"> </div>
   <div class="clod-md-6"> 
     <div class="row">   

       <table id="myTable" class="table dataTable no-footer dtr-inline collapsed">
        <thead class="thead-light">
          <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Observación</th>
            <th>Bodega</th>  
            <th>Gestionar</th>       
          </tr>
        </thead>
        <tbody>
          @foreach($productos as $producto) 
          <tr>
            <td>{{$producto->codigo_producto}}</td>
            <td>{{$producto->nombre_producto}}</td>
            <td>{{$producto->observacion_producto}}</td>
            <td>{{$producto->nombre_bodega}}</td>
            <td><a class="btn btn-outline-primary btn-sm" href="modificar-producto/{{$producto->codigo_producto}}"> Modificar </a>
              <a class="btn btn-outline-danger btn-sm" onclick="eliminar({{$producto->id}})"> Eliminar  </a></td>

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

      <script type="text/javascript">
        function eliminar(id){
         Swal.fire({
          title: 'Está seguro',
          text: "Al eliminar un producto no podra revertir los cambios",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href="eliminar-producto/"+id;
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
              )
          }
        })

      }


    </script>

  </div> 
</div> 
</div> 
</div>      
</div>  


@endsection
