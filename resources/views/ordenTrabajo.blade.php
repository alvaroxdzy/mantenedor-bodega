@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-primary mb-3">
        <h4 style="text-align:center;"> ORDEN DE TRABAJO</h4>
    </div>

    <input type="hidden" name="folios" value="{{$folios->folio}}" id="folios">

    <div class="card border-primary mb-3">
        <div class="row"> 

            <div class="mb-3 col-md-4"> 

                <label> Solicitante </label>
                <select class="form-control" onchange="cargarFolio()" onclick="cargarFolio();"> 
                    @foreach($empleado as $empleados)
                    <option value="{{$empleados->rut}}"> {{$empleados->nombres}} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-md-2" style="width: 22.2%;">
                <label> FOLIO  </label >
                <input class="form-control" name="num_documento" type="text" id="num_documento" required readonly> 
            </div> 
        </div>
    </div>


    <div class="card border-primary mb-3"> 

        <!-- <marquee > Ingreso de movimientos </marquee >  -->

        <div class="card-body">
          <form class="form-inline">  
            <div>
             <div class="row">
                <div class="mb-3 col-md-2" style="width: 22.2%;">
                    <label> FECHA  </label >
                    <input class="form-control" name="fecha" type="date" id="fecha" required value="<?php echo date("d-m-Y\TH-i");?>"> 

                </div> 
                <div class="mb-3 col-md-4">
                    <label> BODEGA  </label>
                    <select class="form-control" name="cod_bodega" id="cod_bodega" required>

                        @foreach($bodega as $bodegas)
                        <option value="{{$bodegas->codigo_bodega}}"> {{$bodegas->nombre_bodega}} </option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3 col-md-2">
                    <label> PATENTE  </label>
                    <select class="form-control" name="patente" id="patente" required onchange="cargarDetallePatente(this)">
                        <option value="0">----- NO APLICA -----</option>
                        @foreach($vehiculo as $vehiculos)
                        <option value="{{$vehiculos->patente}}"> {{$vehiculos->patente}} </option>
                        @endforeach
                    </select>
                </div>

                
            </div> 
            <div class="row"> 

                <div class="mb-3 col-md-2" style="width: 22.2%;">
                    <label> TIPO  </label >
                    <input class="form-control" name="tipo_camion" type="text" id="tipo_camion" required readonly> 

                </div> 
                <div class="mb-3 col-md-2" style="width: 23.2%;">
                    <label> MARCA  </label>
                    <input class="form-control "name="marca" type="text" id="marca" readonly> 
                </div>               


                <div class="mb-3 col-md-2" style="width: 24.2%;">
                    <label> MODELO  </label>
                    <input class="form-control "name="modelo" id="modelo" type="text" readonly  > 
                </div>

                <div class="mb-3 col-md-2" style="width: 24.2%;">
                    <label> AÑO  </label>
                    <input class="form-control "name="anio" id="anio" type="text" readonly > 
                </div>

                <input value="{{$userId = Auth::user()->name;}}" id="usuario" type="hidden" name="usuario">
            </div>

        </div> 
    </div>

</div>

<div class="card border-primary mb-3"> 
    <div class="card-body">

       <table class="table table-sm" id="tablaEmpleados" style="width:100%">
          <thead>
            <h5> PERSONAL ASIGNADO</h5>
            <tr>
                <th>EMPLEADO</th>
                <th>RUT</th>
                <th>CARGO</th>
                <th>FECHA INICIO</th>
                <th>FECHA TERMINO</th>
                <th>DESCRIPCION</th>
                <th>GESTIONAR</th>
            </tr>
        </thead>
        <tbody id="tbodyEmpleado">
            <input type="hidden" name="contador" value="0" id="contador">
        </tbody>
    </table>
    <button class="btn btn-outline-primary btn-sm" type="button" id="agregar_emp"  > AGREGAR PERSONAL </button>
</div>
</div>


<div class="card border-primary mb-3"> 
    <div class="card-body">
        <h5> DIAGNOSTICO </h5>
        <textarea style="text-transform:uppercase" type="text-center" class="form-control" id="diagnostico"  name="diganostico"  onkeyup="javascript:this.value=this.value.toUpperCase();" for="diagnostico"></textarea>
    </div>
</div>


<div class="card border-primary mb-3"> 
    <div class="card-body">

     <table class="table table-sm" style="width:100%">
      <thead>
        <h5> PRESUPUESTO ASIGNADO</h5>
        <tr>
            <th>CODIGO PRODUCTO</th>
            <th>PRODUCTO</th>
            <th>CANTIDAD</th>
            <th>STOCK</th>
            <th>SALDO</th>
            <th>PRECIO UNITARIO</th>
            <th>GESTIONAR</th>
        </tr>
    </thead>
    <tbody id="tbodyProductos">

        <input type="hidden" name="contador2" value="0" id="contador2">

    </tbody>
</table>
<button class="btn btn-outline-primary btn-sm" type="button" id="agregar_prod"  > AGREGAR REPUESTOS </button>

</div>

<div class="card-body">
 <table class="table table-sm" style="width:100%">
  <thead>
    <tr>
        <th>SERVICIOS</th>
        <th>DESCRIPCION:</th>
        <th>VALOR:</th>
        <th>GESTIONAR</th>
    </tr>
</thead>
<tbody id="tbodyServicios">
    <input type="hidden" name="contador3" value="0" id="contador3">
</tbody>
</table>
<button class="btn btn-outline-primary btn-sm" type="button" id="agregar_serv"  > AGREGAR SERVICIOS </button>

</div>
</div>

<div class="card border-primary mb-3"> 
    <div class="card-body">
        <h5> TRABAJOS REALIZADOS </h5>
        <textarea style="text-transform:uppercase" type="text-center" class="form-control" id="trabajos_realizados"  name="trabajos_realizados"  onkeyup="javascript:this.value=this.value.toUpperCase();" for="trabajos_realizados"></textarea>
    </div>
</div>

<div class="card border-primary mb-3"> 
    <div class="card-body">
        <h5> OBSERVACIONES SUPERVISOR </h5>
        <textarea style="text-transform:uppercase" type="text-center" class="form-control" id="observaciones"  name="observaciones"  onkeyup="javascript:this.value=this.value.toUpperCase();" for="observaciones"></textarea>
    </div>
</div>

<div class="row">
 <div class="mb-3 col-md-3" style="width: 25%;">
    <button class="btn btn-primary btn-sm" type="button"> Guardar </button>
</div>
<div class="mb-3 col-md-3" style="width: 25%;">
    <button class="btn btn-primary btn-sm" type="button"> Imprimir </button>
</div>
<div class="mb-3 col-md-3" style="width: 25%;">
    <button class="btn btn-primary btn-sm" type="button"> Cerrar </button>
</div>
<div class="mb-3 col-md-3" style="width: 25%;">
    <button class="btn btn-primary btn-sm" type="button"> Anular </button>
</div>
</div>

</form>
</div>



<script type="text/javascript">
    function cargarFolio() 
    {
      var folio =  $('#folios').val();
      console.log(folio);
      $('#num_documento').val(folio);
  }
</script>

<script type="text/javascript">
    window.onload = function(){
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
document.getElementById('fecha').value=ano+"-"+mes+"-"+dia;
}
</script>

<script type="text/javascript">
    function cargarDetallePatente(vehiculo) {
      try {

        var patente=vehiculo.value;
        console.log(vehiculo.value);

        $.get('traer-vehiculo/' + patente, function(data){

         $('#tipo_camion').val(data.tipo_camion);
         $('#marca').val(data.marca);
         $('#modelo').val(data.modelo);
         $('#anio').val(data.anio);
     });
    } catch (e) {}

}
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var contador = 0;
        $('#agregar_emp').on('click',function(){

            if (contador==0){
            } else {
                $('#borrar_btn'+contador).attr('hidden',true);
            }

            contador = contador+1;
            $('#contador').val(contador);

            traerEmpleados(); 

            $(document).on('click','#borrar_btn'+contador,function(){

                $(this).closest('tr').remove();
                contador = contador-1;
                $('#contador').val(contador);
                $('#borrar_emp'+contador).attr('hidden',false);
            });
        })
    });

</script>

<script type="text/javascript">
    function cargarEmpleado(empleados) {
      try {
        console.log(empleados);
        var numero = empleados.id;
        numero = numero.substring(14);
        nombres=empleados.value;

        $.get('traer-empleado/' + nombres, function(data){

         $('#rut'+numero).val(data.rut);
         $('#cargo'+numero).val(data.cargo);
     });
    } catch (e) {}
}
</script>


<script type="text/javascript">
    function traerEmpleados () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"traer-empleados", //url guarda la ruta hacia donde se hace la peticion
         data:{
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
            console.log(data);

            contador = $('#contador').val();

            var html = '';
            html+='<tr>';
            html+='<td > <select id="selectEmpleado'+contador+'" onchange="cargarEmpleado(this)" class="form-control" required><option value="">---SELECCIONE EMPLEADO---</option>' ; 
            data.forEach(function(empleado) {
               html+='<option value="'+empleado.nombres+'">'+empleado.nombres+'</option>'; 
           });
            html+='</select> </td>' ;
            html+='<td><input id="rut'+contador+'" class="form-control" type="text" name="rut" required readonly></td>';
            html+='<td><input id="cargo'+contador+'" class="form-control"  type="text" name="cargo" required readonly></td>';
            html+='<td><input class="form-control" id="fecha_inicio'+contador+'" type="date" name="fecha_inicio" required ></td>';
            html+='<td><input class="form-control" id="fecha_termino'+contador+'" type="date" name="fecha_termino"  ></td>';
            html+='<td><input id="descripcion'+contador+'" class="form-control" type="text" name="descripcion"></td>';
            html+='<td><button class="btn btn-primary"  id="borrar_btn'+contador+'" type="button"> Eliminar </button> </td>';
            html+='<tr>';

            $('#tbodyEmpleado').append(html);
        },
    });


    }


</script>

<script type="text/javascript">
    $(document).ready(function(){
        var contador2 = 0;
        $('#agregar_prod').on('click',function(){
        //    $('#selectDocumento').attr("disabled", true);

        if (contador2==0){

        } else {
            $('#borrar_btn'+contador2).attr('hidden',true);
        }

        contador2 = contador2+1;
        $('#contador2').val(contador2);

        productoBodegas();
        $('#cod_bodega').attr("disabled", true);

        $(document).on('click','#borrar_btn'+contador2,function(){

            $(this).closest('tr').remove();
            contador2 = contador2-1;
            $('#contador2').val(contador2);
            $('#borrar_btn'+contador2).attr('hidden',false);

        });
    })

    });

</script>

<script type="text/javascript">
    function productoBodegas () {

        cod_bodega =  $('#cod_bodega option:selected').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"producto-bodega/"+cod_bodega, //url guarda la ruta hacia donde se hace la peticion
         data:{
             "cod_bodega":cod_bodega
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
            console.log(data);

            contador2 = $('#contador2').val();

            var html = '';
            html+='<tr>';
            html+='<td style="width:300px"> <select style="width:300px" id="selectProducto'+contador2+'" onchange="cargarProducto(this),cargarStock(this),promedioNeto(this)" class="form-control" required><option value="">---SELECCIONE PRODUCTO---</option>' ; 
            data.forEach(function(producto) {
                html+='<option value="'+producto.id+'">'+producto.codigo_producto+'</option>'; 
            });
            html+='</select> </td>' ;
            html+='<td><input id="nombre_producto'+contador2+'" class="form-control" type="text" name="nombre_producto" required minlength="1" readonly></td>';
            html+='<td style="width:100px"><input style="width:100px" id="cantidad'+contador2+'" class="form-control" oninput="calcularSaldoOT(this)" type="text" name="cantidad" required placeholder="" onkeypress="return valideKey(event);"></td>';
            html+='<td style="width:150px"><input class="form-control" style="width:150px" id="stock'+contador2+'" type="text" name="stock" required value="0" readonly></td>';
            html+='<td style="width:150px"><input class="form-control" style="width:150px" id="saldo'+contador2+'" type="text" name="saldo" required readonly></td>';
            html+='<td><input id="neto'+contador2+'" class="form-control" type="text" name="neto" readonly></td>';
            html+='<td><button class="btn btn-primary"  id="borrar_btn'+contador2+'" type="button"> Eliminar </button> </td>';
            html+='<tr>';

            $('#tbodyProductos').append(html);
        },
    });
    }

</script>

<script type="text/javascript">
    $(document).ready(function(){
        var contador3 = 0;
        $('#agregar_serv').on('click',function(){

            if (contador3==0){

            } else {
                $('#borrar_btn'+contador3).attr('hidden',true);
            }

            contador3 = contador3+1;
            $('#contador3').val(contador3);

            servicios();
            $('#cod_bodega').attr("disabled", true);

            $(document).on('click','#borrar_btn'+contador3,function(){

                $(this).closest('tr').remove();
                contador3 = contador3-1;
                $('#contador3').val(contador3);
                $('#borrar_btn'+contador3).attr('hidden',false);

            });
        })

    });

</script>

<script type="text/javascript">
    function servicios() {

     contador3 = $('#contador3').val();

     var html = '';
     html+='<tr>';
     html+='<td><input id="servicio'+contador3+'" class="form-control" type="text" name="servicio" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>';
     html+='<td><input id="descripcion_servicio'+contador3+'" class="form-control" type="text" name="descripcion_servicio" onkeyup="javascript:this.value=this.value.toUpperCase();" ></td>';
     html+='<td><input id="valor_servicio'+contador3+'" class="form-control" type="text" name="valor_servicio" onkeypress="return valideKey(event);""></td>';
     html+='<td><button class="btn btn-primary"  id="borrar_btn'+contador3+'" type="button"> Eliminar </button> </td>';
     html+='<tr>';

     $('#tbodyServicios').append(html);
 };

</script>

@endsection

