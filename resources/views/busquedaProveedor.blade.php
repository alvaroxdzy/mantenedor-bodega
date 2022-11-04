@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5>LISTADO PROVEEDORES</h5>
  <div > 
   <form class="form-text-input" type="get">
    <a href="crear-proveedor" class="btn btn-outline-primary btn-sm" role="button">CREAR</a>
  </form>
</div>
<div class="row"> 
 <div class="clod-md-4"> </div>
 <div class="clod-md-6"> 
   <div class="row">   
     <table id="myTable" class="table table-sm "  style="width:100%" >
      <thead >
        <tr>
          <th>Rut</th>
          <th>Razón</th>
          <th>Giro</th>
          <th>Dirección</th>
          <th>Gestionar</th> 
        </thead>
        <tbody>
        </tr>
        @foreach($proveedores as $proveedor) 
        <tr>
          <td><a style="color:black " href="modificar-proveedor/{{$proveedor->rut_proveedor}}">{{$proveedor->rut_proveedor}}</a> </td>
          <td id="td-datatable">{{$proveedor->razon_social}}</td>
          <td id="td-datatable">{{$proveedor->giro}}</td>
          <td id="td-datatable">{{$proveedor->direccion_prov}}</td>
          <td> <a class="btn btn-outline-danger btn-sm"  onclick="eliminar({{$proveedor->rut}})"> Eliminar  </a></td>
        </tr>
        @endforeach
      </tbody>
    </table> 


    <script>
     var dataTable = new DataTable("#myTable", {
      perPage: 10,
      sortable: true,
      fixedColumns: false,
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
      text: "No podra revertir los cambios",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
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

</div> 
</div> 
</div> 
</div>      
</div>  


@endsection
