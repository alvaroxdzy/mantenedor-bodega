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

                <label> SOLICITANTE </label>
                <select class="form-control" id="solicitante" name="solicitante" required > 
                    <option value="">-------</option>
                    @foreach($empleado as $empleados)
                    <option value="{{$empleados->rut}}"> {{$empleados->nombres}} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-md-2" style="width: 22.2%;">
                <label> FOLIO  </label >
                <input class="form-control" name="num_documento" type="text" id="num_documento" required readonly> 
            </div> 
            <div class="mb-3 col-md-3" >
                <label> ESTADO  </label>
                <input class="form-control "name="estado" id="estado" type="text" value="DISPONIBLE" readonly > 
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
                <div class="mb-3 col-md-3">
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

                <div class="mb-3 col-md-2" >
                    <label> KILOMETRAJE  </label >
                    <input class="form-control" name="kilometraje" type="text" id="kilometraje" required readonly> 

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
    <tbody id="tbodyProductos" >

        <input type="hidden" name="contador2" value="0" id="contador2">

    </tbody>
</table>
<button class="btn btn-outline-primary btn-sm" type="button" id="agregar_prod"  > AGREGAR REPUESTOS </button>

</div>

<div class="card-body">
    <table class="table table-sm" style="width:100%" id="tableServicios">
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
    <button class="btn btn-primary btn-sm" type="button" onclick="grabarOrden()"> GUARDAR </button>
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
    function cargarFecha()
    {
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

            contador = $('#contador').val();
            contador++;

            $('#contador').val(contador);

            traerEmpleados(); 

            $(document).on('click','#borrar_btn'+contador,function(){

                $(this).closest('tr').remove();
                contador = contador-1;
                $('#contador').val(contador);
                $('#borrar_btn'+contador).attr('hidden',false);
            });
        })
    });

</script>

<script type="text/javascript">
    function cargarEmpleado(empleados) {
      try {
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

         var fecha = new Date(); //Fecha actual
         var mes = fecha.getMonth()+1; //obteniendo mes
         var dia = fecha.getDate(); //obteniendo dia
         var ano = fecha.getFullYear(); //obteniendo año
         if(dia<10)
         dia='0'+dia; //agrega cero si el menor de 10
     if(mes<10)
         mes='0'+mes //agrega cero si el menor de 10

     fecha = ano+"-"+mes+"-"+dia;
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

            contador = $('#contador').val();
            console.log(fecha);

            var html = '';
            html+='<tr>';
            html+='<td > <select style="width:350px" id="selectEmpleado'+contador+'" class="form-control" onchange="cargarEmpleado(this)" required><option value="">-------</option>' ; 
            data.forEach(function(empleado) {
               html+='<option value="'+empleado.nombres+'">'+empleado.nombres+'</option>'; 
           });
            html+='</select> </td>' ;
            html+='<td><input style="width:100px" id="rut'+contador+'"  type="text" name="rut" required readonly></td>';
            html+='<td><input style="width:200px" id="cargo'+contador+'"   type="text" name="cargo" required readonly></td>';
            html+='<td><input id="fecha_inicio'+contador+'" type="date" name="fecha_inicio" required value='+fecha+' ></td>';
            html+='<td><input id="fecha_termino'+contador+'" type="date" name="fecha_termino"  ></td>';
            html+='<td><input id="detalle'+contador+'"  type="text" name="detalle" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>';
            html+='<td><button id="borrar_btn'+contador+'" type="button"> Eliminar </button> </td>';
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
                $('#borrar_btn2'+contador2).attr('hidden',true);
            }
            contador2 = $('#contador2').val();
            contador2++;
            $('#contador2').val(contador2);

            productoBodegas();
            $('#cod_bodega').attr("disabled", true);

            $(document).on('click','#borrar_btn2'+contador2,function(){

                $(this).closest('tr').remove();
                contador2 = contador2-1;
                $('#contador2').val(contador2);
                $('#borrar_btn2'+contador2).attr('hidden',false);

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
            html+='<td> <select id="selectProducto'+contador2+'" class="form-control" onchange="cargarProducto(this),cargarStock(this),promedioNeto(this)" required><option value="">------</option>' ; 
            data.forEach(function(producto) {
                html+='<option value="'+producto.codigo_producto+'">'+producto.codigo_producto+'</option>'; 
            });
            html+='</select> </td>' ;
            html+='<td><input id="nombre_producto'+contador2+'"  type="text" name="nombre_producto" required minlength="1" readonly></td>';
            html+='<td><input id="cantidad'+contador2+'"  oninput="calcularSaldoOT(this)" type="text" name="cantidad" value="0" onkeypress="return valideKey(event);"></td>';
            html+='<td><input id="stock'+contador2+'" type="text" name="stock" required value="0" readonly></td>';
            html+='<td><input id="saldo'+contador2+'" type="text" name="saldo" required readonly></td>';
            html+='<td><input id="neto'+contador2+'"  type="text" name="neto" readonly></td>';
            html+='<td><button id="borrar_btn2'+contador2+'" type="button"> Eliminar </button> </td>';
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
                $('#borrar_btn3'+contador3).attr('hidden',true);
            }

            contador3 = $('#contador3').val();
            contador3++;
            $('#contador3').val(contador3);

            servicios();
            $('#cod_bodega').attr("disabled", true);

            $(document).on('click','#borrar_btn3'+contador3,function(){

                $(this).closest('tr').remove();
                contador3 = contador3-1;
                $('#contador3').val(contador3);
                $('#borrar_btn3'+contador3).attr('hidden',false);

            });
        })

    });

</script>

<script type="text/javascript">
    function servicios() {

     contador3 = $('#contador3').val();

     var html = '';
     html+='<tr>';
     html+='<td><input style="width:300px" id="servicio'+contador3+'"  type="text" name="servicio" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>';
     html+='<td><input style="width:300px" id="descripcion_servicio'+contador3+'" type="text" name="descripcion_servicio" onkeyup="javascript:this.value=this.value.toUpperCase();" ></td>';
     html+='<td><input style="width:300px" id="valor_servicio'+contador3+'"  type="text" name="valor_servicio" onkeypress="return valideKey(event);""></td>';
     html+='<td><button   id="borrar_btn3'+contador3+'" type="button"> Eliminar </button> </td>';
     html+='<tr>';

     $('#tbodyServicios').append(html);
 };

</script>


<script type="text/javascript">
    function grabarOrden()
    {
       m = 0;
       e = $('#contador').val();
       arrayPersonal = [];


       if (e == 0 ){
        arrayPersonal;
    } else {

        while (m < e) {
          m ++;

          var datos = {
            'empleado':$("#selectEmpleado"+m+" option:selected").text(),
            'rut':$("#rut"+m).val(),
            'cargo':$('#cargo'+m).val(),
            'fecha_inicio':$('#fecha_inicio'+m).val(),
            'fecha_termino':$('#fecha_termino'+m).val(),
            'detalle':$('#detalle'+m).val()
        };

        arrayPersonal.push(datos);

    }
}

n = 0;
p = $('#contador2').val();
arrayProductos = [];


if (p == 0 ){
    arrayProductos;
} else {

    while (n < p) {
      n ++;

      var datos2 = {
        'cod_producto':$("#selectProducto"+n+" option:selected").text(),
        'producto':$("#nombre_producto"+n).val(),
        'cantidad':'-'+$('#cantidad'+n).val(),
        'precio':$('#neto'+n).val()
    };
    arrayProductos.push(datos2);

}
}

o = 0;
s = $('#contador3').val();
arrayServicios = [];


if (s == 0 ){
    arrayServicios;
} else {

    while (o < s) {
      o ++;

      var datos3 = {
        'servicio':$("#servicio"+o).val(),
        'descripcion_servicio':$("#descripcion_servicio"+o).val(),
        'valor_servicio':$('#valor_servicio'+o).val()
    };
    arrayServicios.push(datos3);
}
}
   //console.log(arrayServicios);
console.log(arrayProductos);
   //console.log(arrayPersonal);
num_documento = $('#num_documento').val();
usuario = $('#usuario').val();
solicitante = $('#solicitante').val();
fecha= $('#fecha').val();
patente= $('#patente').val();
tipo_camion = $('#tipo_camion').val();
marca = $('#marca').val();
modelo = $('#modelo').val();
anio = $('#anio').val();
kilometraje = $('#kilometraje').val();

cod_bodega = $('#cod_bodega').val();
diagnostico = $('#diagnostico').val();
trabajos_realizados = $('#trabajos_realizados').val();
observaciones = $('#observaciones').val();
estado = $('#estado').val();

console.log(usuario,solicitante,fecha,patente,tipo_camion,marca,modelo,anio,cod_bodega,diagnostico,trabajos_realizados,observaciones);


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/almacenar-orden-trabajo", //url guarda la ruta hacia donde se hace la peticion
         data:{
            "solicitante":solicitante,
            "usuario":usuario,
            "patente":patente,
            "tipo_camion":tipo_camion,
            "marca":marca,
            "modelo":modelo,
            "anio":anio,
            "kilometraje":kilometraje,
            "fecha":fecha,
            "num_documento":num_documento,
            "cod_bodega":cod_bodega,
            "diagnostico":diagnostico,
            "trabajos_realizados":trabajos_realizados,
            "observaciones":observaciones,
            "estado":estado,
            "arrayServicios":arrayServicios,
            "arrayPersonal":arrayPersonal,
            "arrayProductos":arrayProductos
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
            console.log(data);

            if (data=='LISTASO') {
                alert('ORDEN REGISTRADA');
                GrabarSalidaOT();
            } else {
                alert('FOLIO  VENCIDO INTENTE NUEVAMENTE');
                var num = document.getElementById("num_documento");
                console.log(num.value);
                num.value = parseInt(num.value,10)+1;      
            }

        },
    });

}

</script>


<script type="text/javascript">
    function GrabarSalidaOT()
    {
        n = 0;
        p = $('#contador2').val();
        arrayProductos = [];


        if (p == 0 ){
            arrayProductos;
        } else {

            while (n < p) {
              n ++;

              var datos2 = {
                'cod_producto':$("#selectProducto"+n+" option:selected").text(),
                'producto':$("#nombre_producto"+n).val(),
                'cantidad':'-'+$('#cantidad'+n).val(),
                'precio':$('#neto'+n).val()
            };
            arrayProductos.push(datos2);

        }
    }
    num_documento = $('#num_documento').val();
    usuario = $('#usuario').val();
    fecha= $('#fecha').val();
    patente= $('#patente').val();
    cod_bodega = $('#cod_bodega').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/almacenar-movimiento-ot", //url guarda la ruta hacia donde se hace la peticion
         data:{
           "usuario":usuario,
           "patente":patente,
           "fecha":fecha,
           "num_documento":num_documento,
           "cod_bodega":cod_bodega,
           "arrayProductos":arrayProductos
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
            console.log(data);

            if (data=='ARREGLO VACIO') {
                console.log('arreglo vacio');
            }

            if (data=='LISTASO') {
                console.log('Movimiento registrado');    
            }

        },
    });

}

</script>

<script type="text/javascript">
    function limpiarTodo()
    {
        document.getElementById('diagnostico').value="";
        document.getElementById('trabajos_realizados').value="";
        document.getElementById('observaciones').value="";
        document.getElementById('patente').value="---------";
        document.getElementById('solicitante').value="-----";
        document.getElementById('num_documento').value="";
        document.getElementById('contador').value=0;
        document.getElementById('contador2').value=0;
        document.getElementById('contador3').value=0;
    }
</script>

<script type="text/javascript">
    window.onload=cargarFolio();
    window.onload=cargarFecha();
    window.reload=limpiarTodo();   
    window.reload=cargarFolio();
</script>


@endsection

