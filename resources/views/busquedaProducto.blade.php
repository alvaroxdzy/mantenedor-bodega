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
       @if(@Auth::user()->hasRole('colaborador'))
       <table id="myTable" class="table dataTable no-footer dtr-inline collapsed">
        <tr>
          <th>Codigo</th>
          <th>Producto</th>
          <th>Observación</th>
          <th>Bodega</th>  
          <th>Gestionar</th>       
        </tr>
        @foreach($productos as $producto) 
        <tr>
          <td> {{$producto->codigo_producto}} </td>
          <td>{{$producto->nombre_producto}}</td>
          <td>{{$producto->observacion_producto}}</td>
          <td>{{$producto->nombre_bodega}}</td>
          <td><a class="btn btn-outline-primary btn-sm" href="modificar-producto/{{$producto->codigo_producto}}"> Modificar </a></td>
          <td><a class="btn btn-outline-primary btn-sm" onclick="eliminar({{$producto->id}})"> Eliminar  </a></td>

        </tr>
        @endforeach
      </table>  
      <script>
        var myTable = document.querySelector("#myTable");
        var dataTable = new DataTable(myTable);
      </script>
      <script type="text/javascript">
        function eliminar(id){
         Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
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
    @endif
  </div> 
</div> 
</div> 
</div>      
</div>  


@endsection
