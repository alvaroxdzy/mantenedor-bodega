
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

    <h2> Productos entregados por empleado</h2>

<table id="myTable" class="table dataTable no-footer dtr-inline collapsed table-striped" style="width:100%">
  <thead class="thead-light">
    <tr>
      <th>rut</th>
      <th>nombres</th>
      <th>productos entregados</th> 
    </tr>
  </thead>
  <tbody id="trTable">
    @foreach($inventarioEmpleadoPDF as $inventarioEmpleadoPDFs) 
    <tr>
      <td>{{$inventarioEmpleadoPDFs->rut}}</td>
      <td>{{$inventarioEmpleadoPDFs->nombres}}</td>
      <td style="text-align:center;">{{$inventarioEmpleadoPDFs->productos_entregados}}</td>
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
