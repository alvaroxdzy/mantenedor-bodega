@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h4>Proveedores</h4>
  <div id="div-buscar-proveedor" class=""> 
   <form class="form-text-input" type="get">
    <a href="crear-proveedor" class="btn btn-outline-primary btn-sm" role="button">CREAR</a>
  </form>
</div>
<div class="row"> 
 <div class="clod-md-4"> </div>
 <div class="clod-md-6"> 
   <div class="row">   
     @if(@Auth::user()->hasRole('colaborador'))
     <font size="1" >
       <table id="myTable" class="table dataTable no-footer dtr-inline collapsed" style="width:100%">
        <tr>
          <th class="header" >Rut Proveedor</th>
          <th class="header" >Digito verificador</th>
          <th class="header" >Razon social</th>
          <th class="header" >Giro</th>
          <th class="header" >Dirección</th>
          <th class="header" >Comuna</th>
          <th class="header" >Ciudad</th>
          <th class="header" >Banco</th>
          <th class="header" >Tipo cuenta</th>  
          <th class="header" >Numero cuenta</th> 
          <th class="header" >Telefono proveedor</th>
          <th class="header" >Gestionar</th> 

        </tr>
        @foreach($proveedores as $proveedor) 
        <tr>
          <td>{{$proveedor->rut_proveedor}} </td>
          <td>{{$proveedor->dig_rut_prov}}</td>
          <td>{{$proveedor->razon_social}}</td>
          <td>{{$proveedor->giro}}</td>
          <td>{{$proveedor->direccion_prov}}</td>
          <td>{{$proveedor->comuna_prov}}</td>
          <td>{{$proveedor->ciudad_prov}}</td>
          <td>{{$proveedor->banco}}</td>
          <td>{{$proveedor->tipo_cuenta}}</td>
          <td>{{$proveedor->n_cta_prov}}</td>
          <td> {{$proveedor->telefono_prov}} </td>
          <td><a class="btn btn-outline-primary btn-sm" href="modificar-proveedor/{{$proveedor->rut_proveedor}}"> Modificar </a>
          <a class="btn btn-outline-primary btn-sm" onclick="eliminar({{$proveedor->id}})"> Eliminar  </a></td>
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
            window.location.href="eliminar-proveedor/"+id;
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
  </font>
  @endif
</div> 
</div> 
</div> 
</div>      
</div>  


@endsection
