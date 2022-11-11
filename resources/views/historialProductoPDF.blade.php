
<html>
<head>
  <style>
    @page {
      margin: 0cm 0cm;
      font-family: Arial;
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

    th {
      text-align: left;
    }

    hr {
      page-break-after: always;
      border: 0;
      margin: 0;
      padding: 0;
    }
    html {
      margin: 0;
    }
    body {
      font-family: "Times New Roman", serif;
      margin: 5mm 8mm 2mm 8mm;
    }

  </style>
</head>
<body>
  <main>
    <div  class="container"> 
      <img src="./img/logo.PNG"/>

      <h3> Ingeniería de transportes </h3>
      <h3> JAVIER CORTES </h3>


      <h2 style="text-align: center;"> Historial de producto  </h2>


      <h3>{{$bodega->nombre_bodega}}</h3>
      <h4>PRODUCTO : {{$producto->nombre_producto}}  </h4>
      <h4> CODIGO : {{$producto->codigo_producto}} </h4>
      
      <table id="tabla-historial" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
        <thead class="thead-light">
          <tr>
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
