
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

    <h3 style="text-align:center"> Stock de productos </h3>

<table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
  <thead class="thead-light">
    <tr>
      <th>Codigo</th>
      <th>Producto</th>
      <th>Precio/Unitario</th> 
      <th>Stock</th>  
      <th>Bodega</th>
    </tr>
  </thead>
  <tbody id="trTable">
    @foreach($producto as $productos) 
    <tr>
      <td>{{$productos->cod_producto}}</td>
      <td>{{$productos->nombre_producto}}</td>
      <td>${{$productos->precio}}</td>
      <td style="text-align:right;">{{$productos->stock}}</td>
      <td>{{$productos->nombre_bodega}}</td>
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
