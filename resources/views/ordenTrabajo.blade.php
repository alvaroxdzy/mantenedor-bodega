@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-primary mb-3">
        <h4 style="text-align:center;"> ORDEN DE TRABAJO</h4>
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
                <br>
                <th>EMPLEADO</th>
                <th>RUT</th>
                <th>CARGO</th>
                <th>FECHA INICIO</th>
                <th>FECHA TERMINO</th>
                <th>DESCRIPCION</th>
                <th>GESTIONAR</th>
            </tr>
        </thead>
        <tbody>

            <input type="hidden" name="contador" value="0" id="contador">

        </tbody>
    </table>
    <button class="btn btn-outline-primary btn-sm" type="button" id="agregar_emp"  > AGREGAR PERSONAL </button>
</form>



</div>
</div>
</div>

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

            $('tbody').append(html);
        },
    });


    }


</script>

@endsection

