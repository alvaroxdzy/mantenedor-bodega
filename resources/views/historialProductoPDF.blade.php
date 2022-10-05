
<html>
<head>
  <style>
    @page {
      margin: 0cm 0cm;
      font-family: Arial;
    }

    body {
      margin: 1cm 2cm 2cm;
    }
    footer {
      position: fixed;
      bottom: 0cm;
      left: 0cm;
      right: 0cm;
      height: 1cm;
      background-color: #2a0927;
      color: white;
      text-align: center;
      line-height: 35px;
    }
    h4{
      color: #0a58ca;
    } 
    th {
      text-align: left;
    }
  </style>
</head>
<body>
  <main>
    <div  class="container"> 
     <div class="card" >
      <h3 style="width:30%"> Ingeniería de transportes JAVIER CORTES</h3>
    </div>

    <h2> Historial de productos </h2>

    <table id="tabla-historial" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
      <thead class="thead-light">
        <tr>
          <th>Codigo</th>
          <th>Producto</th>
          <th>Documento</th> 
          <th>Numero</th>
          <th>Tipo</th>  
          <th>Fecha</th>  
          <th>Cantidad</th>   
          <th>Estado</th>
          <th>Usuario</th>     

        </tr>
      </thead>
      <tbody>
        @foreach($movimiento as $movimientos) 
        <tr>
          <td>{{$movimientos->cod_producto}}</td>
          <td>{{$movimientos->nombre_producto}}</td>
          <td>{{$movimientos->tipo_documento}}</td>
          <td>{{$movimientos->nro_documento_mov}}</td>
          <td>{{$movimientos->tipo}}</td>
          <td>{{$movimientos->fecha}}</td>
          <td>{{$movimientos->cantidad}}</td>
          <td>{{$movimientos->estado}} </td>
          <td>{{$movimientos->usuario}} </td>

        </tr>
        @endforeach
      </tbody>
    </table>  
  </div>
</main>

</body>
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
</html>
