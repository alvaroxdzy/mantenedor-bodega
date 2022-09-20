@extends('layouts.app')

@section('content')









<div class="card"> 

    <div class="card-body">
        <div>
         <div class="row">
            <div class="mb-3 col-md-2">

                <label> TIPO DE DOCUMENTO</label>
                <select class="form-control" id="selectDocumento" name="tipo_documento"> 
                    <option>FACTURA </option>
                    <option>GUIA </option>
                    <option>COMPROBANTE DE INGRESO </option>
                </select>
            </div>
            <div class="mb-3 col-md-2">
                <label> NRO DOCUMENTO </label>
                <input  class="form-control" type="text" name="num_documento" required onkeypress="return valideKey(event);" >
            </div>
            <div class="mb-3 col-md-2">
                <label> PROVEEDOR  </label>
                <select class="form-control" name="rut_proveedor" required >
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
                <select class="form-control" name="cod_bodega" required>

                    @foreach($bodega as $bodegas)
                    <option value="{{$bodegas->codigo_bodega}}"> {{$bodegas->nombre_bodega}} </option>
                    @endforeach
                </select>

            </div>
            <div class="mb-3 col-md-2">
                <label> FECHA  </label >
                <input class="form-control" name="fecha" type="text" size= "10"  id="fecha" value="" / required> 

            </div> 
            <div class="mb-3 col-md-2">
                <label> TIPO DE MOVIMIENTO  </label>
                <input class="form-control "name="tipo" type="text" value="INGRESO" readonly> 
            </div>               


            <div class="mb-3 col-md-2">
                <label> ESTADO  </label>
                <input class="form-control "name="estado" type="text" value="DISPONIBLE" readonly > 
            </div>
            <input value="{{$userId = Auth::user()->name;}}" type="hidden" name="usuario">
        </div>

    </div>    
</div>

</div>


<div class="card"> 
    <div class="card-body">

        <form class="form-inline">  
           <table class="table table-sm" id="tableMovimiento" style="width:100%">
              <thead>
                <button class="btn btn-outline-primary btn-sm" type="button" id="agregar_btn"  > AGREGAR DETALLE </button>
                <br>
                <tr>
                    <br>
                    <th>Codigo producto:</th>
                    <th>Producto:</th>
                    <th>Cantidad:</th>
                    <th>Valor unitario(neto):</th>
                    <th>IVA</th>
                    <th>Total:</th>
                    <th>Gestionar</th>
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
        //    $('#selectDocumento').attr("disabled", true);

        if (contador==0){

        } else {
            $('#borrar_btn'+contador).attr('hidden',true);
        }

        contador = contador+1;
        var html = '';
        html+='<tr>';
        html+='<td style="width:300px"> <select style="width:300px" id="selectProducto'+contador+'" onchange="cargarProducto(this)" class="form-control" required><option value="">---SELECCIONE PRODUCTO---</option> @foreach($producto as $productos) <option value="{{$productos->id}}"> {{$productos->codigo_producto}} </option> @endforeach </select> </td>';
        html+='<td><input id="nombre_producto'+contador+'" class="form-control" type="text" name="nombre_producto" required minlength="1" readonly></td>';
        html+='<td style="width:100px"><input style="width:100px" id="cantidad'+contador+'" class="form-control" oninput="multiplicar(this)" type="text" name="cantidad" required placeholder="" onkeypress="return valideKey(event);"></td>';
        html+='<td style="width:150px"><input class="form-control" style="width:150px" id="valoress'+contador+'" oninput="multiplicar(this)"  type="text" name="neto" required onkeypress="return valideKey(event);"></td>';
        html+='<td style="width:150px"><input class="form-control" style="width:150px" id="iva'+contador+'" type="text" name="iva" required readonly></td>';
        html+='<td style="width:200px"><input style="width:200px" id="total'+contador+'" class="form-control" type="text" name="total" readonly required placeholder=""></td>';
        html+='<td><button class="btn btn-primary"  id="borrar_btn'+contador+'" type="button"> Eliminar </button> </td>';
        html+='<tr>';
        

        $('tbody').append(html);

            $(document).on('click','#borrar_btn'+contador,function(){
            
            $(this).closest('tr').remove();
            contador = contador-1;
            $('#borrar_btn'+contador).attr('hidden',false);

        });
    })

    });

</script>


@endsection

