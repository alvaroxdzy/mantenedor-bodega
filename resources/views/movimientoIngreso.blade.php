@extends('layouts.app')

@section('content')

<div class="card"> 
    <div class="card-body">
        <div>
         <div class="row">
            <div class="mb-3 col-md-2">
                <label> TIPO DE DOCUMENTO</label>
                <select class="form-control"> 
                    <option>FACTURA </option>
                    <option>GUIA </option>
                    <option>COMPROBANTE DE INGRESO </option>
                </select>
            </div>
            <div class="mb-3 col-md-2">
                <label> NRO DOCUMENTO </label>
                <input  class="form-control" type="text" name="">
            </div>
            <div class="mb-3 col-md-2">
                <label> PROVEEDOR  </label>
                <select class="form-control">
                    <option value="">----- NO POSEE -----</option>
                    @foreach($proveedor as $proveedores)
                    <option value="{{$proveedores->rut_proveedor}}"> {{$proveedores->razon_social}} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row"> 
            <div class="mb-3 col-md-2">
                <label> BODEGA  </label>
                <select class="form-control">

                    @foreach($bodega as $bodegas)
                    <option value="{{$bodegas->codigo_bodega}}"> {{$bodegas->nombre_bodega}} </option>
                    @endforeach
                </select>

            </div>
            <div class="mb-3 col-md-2">
                <label> FECHA  </label>
                <input class="form-control" name="fecha" type="text" size= "10"  id="fecha" value="<?php echo date("d/m/Y"); ?>" /> 

            </div> 
            <div class="mb-3 col-md-2">
                <label> TIPO DE MOVIMIENTO  </label>
                <input class="form-control "name="" type="text" value="INGRESO" disabled> 
            </div>               


            <div class="mb-3 col-md-2">
                <label> ESTADO  </label>
                <input class="form-control "name="" type="" value="DISPONIBLE" disabled > 
            </div>

        </div>

    </div>    
</div>
</div>


<div class="card"> 
    <div class="card-body">

        <form class="form-inline">  
           <table class="table table-striped" style="width:100%">
              <thead>
                <button class="btn btn-outline-primary btn-sm" type="button" id="agregar_btn"  > AGREGAR DETALLE </button>
                <tr>
                  <th>Codigo producto:</th>
                  <th>Producto:</th>
                  <th>Cantidad:</th>
                  <th>Orden trabajo:</th>
                  <th>Valor:</th>
                  <th>Total:</th>
              </tr>
          </thead>
          <tbody>
            <tr ng-repeat="name in getdrugnameNewArray">

            </tr>
        </tbody>
    </table>
    <input type="submit" class="btn btn-primary"  value="GUARDAR MOVIMIENTO ">  </input>
</form>




</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var contador = 0;
        $('#agregar_btn').on('click',function(){
            contador = contador+1;
            var html = '';
            
            html+='<tr>';
            html+='<td> <select id="selectProducto'+contador+'" onchange="cargarProducto(this)" class="form-control"><option value="">---SELECCIONE PRODUCTO---</option> @foreach($producto as $productos) <option value="{{$productos->id}}"> {{$productos->codigo_producto}} </option> @endforeach </select> </td>';
            html+='<td><input id="nombre_producto'+contador+'" class="form-control" type="text" name="nombre_producto" required placeholder=""></td>';
            html+='<td><input id="cantidad'+contador+'" oninput="multiplicar(this)" class="form-control" type="text" name="cantidad" required placeholder=""></td>';
            html+='<td><input id="orden_trabajo'+contador+'" class="form-control" type="text" name="orden_trabajo" required placeholder=""></td>';
            html+='<td><input id="valor'+contador+'" oninput="multiplicar(this)" class="form-control" type="text" name="valor" required placeholder=""></td>';
            html+='<td><input id="total'+contador+'" class="form-control" type="text" name="total" required placeholder=""></td>';
            html+='<td><button class="btn btn-primary" id="borrar_btn" type="button"> Eliminar </button></td>';
            html+='<tr>';       
            $('tbody').append(html);
            alert(contador);

        })
    });

    $(document).on('click','#borrar_btn',function(){
        $(this).closest('tr').remove();
    });
</script>

<script type="text/javascript">
    function multiplicar(valores){
    var cantidad = valores.id;
    cantidad = cantidad.substring(8);
    }
</script>



<script type="text/javascript">
    function cargarProducto(alvaro) {
        var numero = alvaro.id;
        numero = numero.substring(14);
        id=alvaro.value;

        $.get('productos-movimiento/' + id, function(data){

         $('#nombre_producto'+numero).val(data.nombre_producto);
         console.log(data);
     });
    }
</script>
@endsection

