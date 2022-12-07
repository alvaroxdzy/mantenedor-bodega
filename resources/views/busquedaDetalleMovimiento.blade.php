@extends('layouts.app')

@section('content')



<div class="container">
  <div class="card border-primary mb-3">
    <h4 style="text-align:center;"> MOVIMIENTO BODEGA</h4>
  </div>

  <div class="card border-primary mb-3"> 

    <!-- <marquee > Ingreso de movimientos </marquee >  -->

    <div class="card-body">
      <form class="form-inline">  

       <div class="row">
        <div class="mb-3 col-md-3">

          <label> TIPO DE DOCUMENTO</label>
          <input class="form-control "name="tipo_documento" type="text" id="tipo_documento" value="{{$movimiento->tipo_documento}}" readonly>
        </div>

        <div class="mb-3 col-md-2">
          <label> NRO DOCUMENTO </label>
          <input  class="form-control" type="text" name="num_documento" id="num_documento"  value="{{$movimiento->num_documento}}" readonly>
        </div>

        <div class="mb-3 col-md-2">
          <label> FECHA  </label >
          <input class="form-control" name="fecha" type="date" id="fecha" required value="{{$movimiento->fecha}}" readonly> 

        </div> 

        <div class="mb-3 col-md-4">
          <label> PROVEEDOR  </label>
          <input  class="form-control" type="text" name="rut_proveedor" id="rut_proveedor"  value="{{$detalleFijo->rut_proveedor}}" readonly>
        </div>


      </div>


      <div class="row"> 
        <div class="mb-3 col-md-3">
          <label> BODEGA  </label>
          <input  class="form-control" type="text" name="nombre_bodega" id="nombre_bodega"  value="{{$movimiento->nombre_bodega}}" readonly>

        </div>

        <div class="mb-3 col-md-2">
          <label> TIPO DE MOVIMIENTO  </label>
          <input class="form-control "name="tipo" type="text" id="tipo" value="{{$movimiento->tipo}}" readonly> 
        </div>      
        <div class="mb-3 col-md-2">
          <label> PATENTE  </label>
          <input  class="form-control" type="text" name="patente" id="patente"  value="{{$detalleFijo->patente}}" readonly>

        </div>         
        <div class="mb-3 col-md-4">
          <label> EMPLEADO  </label>
          <input  class="form-control" type="text" name="rut" id="rut"  value="{{$detalleFijo->rut}}" readonly>
        </div>

        <input value="{{$userId = Auth::user()->name;}}" id="usuario" type="hidden" name="usuario">
      </div>

    </div>
  </div>


  <div class="card border-primary mb-3"> 
    <div class="card-body">

     <table class="table table-sm" id="tableMovimiento" style="width:100%">
      <thead>

        <tr>
          <br>
          <th>Codigo </th>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Neto</th>
          <th>IVA</th>
          <th>Total:</th>
        </tr>
      </thead>
      <tbody id="tbodyMovimiento">
        @foreach($detalleMovimiento as $detalle) 
        <tr>
          <td>{{$detalle->cod_producto}} </td>
          <td>{{$detalle->nombre_producto}}</td>
          <td>{{$detalle->cantidad}}</td>
          <td>{{$detalle->neto}}</td>
          <td>{{$detalle->iva}}</td>
          <td>{{$detalle->total}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </form>

</div>
</div>

<script>
 var dataTable = new DataTable("#tabla-historial", {
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
</div> 





@endsection
