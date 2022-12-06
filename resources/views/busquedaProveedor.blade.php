@extends('layouts.app')

@section('content')



<div  class="container"> 
  <h5 style="text-align:center;">LISTADO PROVEEDORES</h5>
  <div > 
    <a href="crear-proveedor" id="btn-crear" class="btn btn-primary btn-sm" role="button">Crear Proveedor</a>
  </div>
  <table id="myTable"  class="table dataTable no-footer dtr-inline collapsed table-striped"  style="width:100%" >
    <thead >
      <tr>
        <th>Rut</th>
        <th>Razon</th>
        <th>Giro</th> 
        <th>Dirección</th>
        <th>Gestionar</th> 
      </thead>
      <tbody>
      </tr>
      @foreach($proveedores as $proveedor) 
      <tr>
        <td><a href="/modificar-proveedor/{{$proveedor->rut_proveedor}}">{{$proveedor->rut_proveedor}}</a></td>
        <td><a href="/modificar-proveedor/{{$proveedor->rut_proveedor}}">{{$proveedor->razon_social}}</a></td>
        <td><a href="/modificar-proveedor/{{$proveedor->rut_proveedor}}">{{$proveedor->giro}}</a></td>
        <td><a href="/modificar-proveedor/{{$proveedor->rut_proveedor}}">{{$proveedor->direccion_prov}}</a></td>
        <td><a class="btn btn-outline-danger btn-sm" id="btn-eliminar" onclick="eliminar({{$proveedor->id}})"> Eliminar </a></td>
      </tr>
      @endforeach
    </tbody>
  </table> 

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

<script>
 var dataTable = new DataTable("#myTable", {
  perPage: 50,
  sortable: true,
  fixedColumns: true,
  perPageSelect: [50, 100, 200],
  labels: {
    placeholder: "Buscar..",
    perPage: "{select}     Registros por pagina",
    noRows: "No se encontraron registros",
    info: "Mostrando registros del {start} hasta el {end} de un total de {rows} registros",
  }

});
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

#btn-eliminar {
  padding: 0.2rem .2rem;
  font-size: 0.9rem;
    margin-left: 4.5px;
}

#btn-crear{
    padding: 0.2rem .3rem;
    font-size: 0.9rem;
    margin-bottom: 10px;

  }

    a {
    text-decoration: none;
    color: black;
  }
</style>


@endsection
