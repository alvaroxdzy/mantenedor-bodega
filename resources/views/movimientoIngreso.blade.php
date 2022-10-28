@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-primary mb-3">
        <h4 style="text-align:center;"> INGRESO A BODEGA</h4>
    </div>

    <div class="card border-primary mb-3"> 

        <!-- <marquee > Ingreso de movimientos </marquee >  -->

        <div class="card-body">
          <form class="form-inline">  
            <div>
               <div class="row">
                <div class="mb-3 col-md-3">

                    <label> TIPO DE DOCUMENTO</label>
                    <select class="form-control" id="tipo_documento" name="tipo_documento"> 
                        <option>FACTURA </option>
                        <option>GUIA </option>
                        <option>COMPROBANTE DE INGRESO </option>
                    </select>
                </div>
                <div class="mb-3 col-md-3">
                    <label> NRO DOCUMENTO </label>
                    <input  class="form-control" type="text" name="num_documento" id="num_documento" required onkeypress="return valideKey(event);" >
                </div>
                <div class="mb-3 col-md-5">
                    <label> PROVEEDOR  </label>
                    <select class="form-control" name="rut_proveedor" id="rut_proveedor" required >
                        <option value="0">----- NO POSEE -----</option>
                        @foreach($proveedor as $proveedores)
                        <option value="{{$proveedores->rut_proveedor}}"> {{$proveedores->razon_social}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row"> 
                <div class="mb-3 col-md-3" style="width: 22.2%;">
                    <label> BODEGA  </label>
                    <select class="form-control" name="cod_bodega" id="cod_bodega" required>

                        @foreach($bodega as $bodegas)
                        <option value="{{$bodegas->codigo_bodega}}"> {{$bodegas->nombre_bodega}} </option>
                        @endforeach
                    </select>

                </div>
                <div class="mb-3 col-md-2" style="width: 22.2%;">
                    <label> FECHA  </label >
                    <input class="form-control" name="fecha" type="date" id="fecha" required value="<?php echo date("d-m-Y\TH-i");?>"> 

                </div> 
                <div class="mb-3 col-md-2" style="width: 23.2%;">
                    <label> TIPO DE MOVIMIENTO  </label>
                    <input class="form-control "name="tipo" type="text" id="tipo" value="INGRESO" readonly> 
                </div>               


                <div class="mb-3 col-md-2" style="width: 24.2%;">
                    <label> ESTADO  </label>
                    <input class="form-control "name="estado" id="estado" type="text" value="DISPONIBLE" readonly > 
                </div>
                <input value="{{$userId = Auth::user()->name;}}" id="usuario" type="hidden" name="usuario">
            </div>

        </div> 
    </div>

</div>


<div class="card border-primary mb-3"> 
    <div class="card-body">

     <table class="table table-sm" id="tableMovimiento" style="width:100%">
      <thead>
        <button class="btn btn-outline-primary btn-sm" type="button" id="agregar_btn"  > AGREGAR DETALLE </button>
        <br>
        <tr>
            <br>
            <th>Codigo </th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Valor unitario(neto)</th>
            <th>IVA</th>
            <th>Total:</th>
            <th>Gestionar</th>
        </tr>
    </thead>
    <tbody id="tbodyMovimiento">

        <input type="hidden" name="contador" value="0" id="contador">

    </tbody>
</table>
<input type="" class="btn btn-primary"  value="GUARDAR MOVIMIENTO " onclick="grabar()">  </input>
</form>



</div>
</div>

<!-- Trigger/Open The Modal -->
<button class="btn btn-outline-primary btn-sm"  id="myBtn">VER PRODUCTOS</button>

<!-- The Modal -->
<div class="modal" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">LISTADO PRODUCTOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
     <table class="table table-sm" id="tableModal" style="width:100%">
      <thead>
        <tr>
            <th>CODIGO </th>
            <th>PRODUCTO</th>
        </tr>
    </thead>
    <tbody id="TbodyModal" >

    </tbody>
</table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-primary btn-sm" id="myBtnCerrar" data-dismiss="modal"> Salir </button>
</div>
</div>
</div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the button that opens the modal
var btnCerrar = document.getElementById("myBtnCerrar");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

btnCerrar.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
}
}
</script>



<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

  $(document).on('click','#myBtn',function(){

    $('#tableModal').DataTable().clear().destroy();

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
            data.forEach(function(data) {
                $('#TbodyModal').append('<tr>'+
                    '<td>'+data.codigo_producto+'</td>'+
                    '<td>'+data.nombre_producto+'</td>'+
                    '</tr>');
            });
        },
    });

});
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
    $(document).ready(function(){
        var contador = 0;
        $('#agregar_btn').on('click',function(){
        //    $('#selectDocumento').attr("disabled", true);

        if (contador==0){

        } else {
            $('#borrar_btn'+contador).attr('hidden',true);
        }

        contador = contador+1;
        $('#contador').val(contador);


        productoBodegas(); 

        $('#cod_bodega').attr("disabled", true);

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

            contador = $('#contador').val();

            var html = '';
            html+='<tr>';
            html+='<td> <select  id="selectProducto'+contador+'" onchange="cargarProducto(this)" class="form-control" required><option value="">------</option>' ; 
            data.forEach(function(producto) {
                html+='<option value="'+producto.codigo_producto+'">'+producto.nombre_producto+'</option>'; 

            });
            html+='</select> </td>' ;
            html+='<td><input style="width:600px" id="nombre_producto'+contador+'" class="form-control" type="text" name="nombre_producto" required minlength="1" readonly></td>';
            html+='<td ><input style="width:75px" id="cantidad'+contador+'" class="form-control" oninput="multiplicar(this)" type="text" name="cantidad" required placeholder="" onkeypress="return valideKey(event);"></td>';
            html+='<td><input style="width:120px" class="form-control"  id="valoress'+contador+'" oninput="multiplicar(this)"  type="text" name="neto" required onkeypress="return valideKey(event);"></td>';
            html+='<td ><input style="width:100px" class="form-control"  id="iva'+contador+'" type="text" name="iva" required readonly></td>';
            html+='<td ><input style="width:100px" id="total'+contador+'" class="form-control" type="text" name="total" readonly required placeholder=""></td>';
            html+='<td><button class="btn btn-primary"  id="borrar_btn'+contador+'" type="button"> Eliminar </button> </td>';
            html+='<tr>';
            $('#tbodyMovimiento').append(html);
        },
    });
    }

</script>

<script type="text/javascript">
    function validarMovimientoIngreso()
    {
        var num_documento = $('num_documento').val();
        if (num_documento == ''){
            alert('PORFAVOR INGRESE NUMERO DOCUMENTO');
            num_documento.focus();
            return false;
        }
        return true;
    }


</script>


<script>
    function grabar ()
    {
     m = 0;
     n = $('#contador').val();
     arrayMovimiento = [];


     if (n == 0 ){
        arrayMovimiento;
    } else {

        while (m < n) {
          m ++;


          var datos = {
            'selectProducto':$("#selectProducto"+m+" option:selected").text(),
            'nombre_producto':$("#nombre_producto"+m).val(),
            'cantidad':$('#cantidad'+m).val(),
            'valoress':$('#valoress'+m).val(),
            'iva':$('#iva'+m).val(),
            'total':$('#total'+m).val(),
            'stock':0,
            'saldo':0
        };

        arrayMovimiento.push(datos);

    }
    console.log(arrayMovimiento);

    usuario = $('#usuario').val();
    tipo_documento = $('#tipo_documento').val();
    fecha = $('#fecha').val();
    tipo = $('#tipo').val();
    estado = $('#estado').val();
    num_documento = $('#num_documento').val();
    cod_bodega = $('#cod_bodega').val();
    rut_proveedor = $('#rut_proveedor').val();

    if (num_documento == ''){
        alert('PORFAVOR INGRESE NUMERO DOCUMENTO');
        $('#num_documento').focus();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/almacenar-movimiento", //url guarda la ruta hacia donde se hace la peticion
         data:{
             "usuario":usuario,
             "tipo_documento":tipo_documento,
             "fecha":fecha,
             "tipo":tipo,
             "estado":estado,
             "num_documento":num_documento,
             "cod_bodega":cod_bodega,
             "rut_proveedor":rut_proveedor,
             "arrayMovimiento":arrayMovimiento
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
            console.log(data);


            if (data=='LISTASO') {
                alert('MOVIMIENTO REGISTRADO');
                location.reload(); 
            } else {
                alert('YA EXISTE UN MOVIMIENTO CON ESTE CODIGO');
            }
        },
    });
}
}
</script>


@endsection

