@extends('layouts.app')

@section('content')

<div class="card"> 
    <div class="card-body">
        <div>
            <div class="row"> 

                <div class="mb-3 col-md-2">
                    <label> N° MOVIMIENTO</label>
                    <input class="form-control "name="" type="text">
                </div>

                <div class="mb-3 col-md-2">
                    <label> BODEGA  </label>
                    <input class="form-control "name="" type="text">

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
                    <label> RUT PROVEEDOR  </label>
                    <input class="form-control "name="" type="text" value="" > 
                </div>

                <div class="mb-3 col-md-2">
                    <label> Estado  </label>
                    <input class="form-control "name="" type="" value="DISPONIBLE" disabled > 
                </div>

            </div>
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
            </div>
        </div>    
    </div>
</div>


<div class="card"> 
    <div class="card-body">

        <form class="form-inline">  
           <table class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>Numero Detalle:</th>
                  <th>Producto:</th>
                  <th>Cantidad:</th>
                  <th>Orden trabajo:</th>
                  <th>Valor:</th>
                  <th>Total:</th>
              </tr>
          </thead>
          <tbody>
            <tr ng-repeat="name in getdrugnameNewArray">
                <td><input class="form-control" type="text" name="num_detalle" placeholder=""></td>
                <td><input class="form-control" type="text" name="cod_producto" placeholder=""></td>
                <td><input class="form-control" type="text" name="cantidad" placeholder=""></td>
                <td><input class="form-control" type="text" name="orden_trabajo" placeholder=""></td>
                <td><input class="form-control" type="text" name="valor" placeholder=""></td>
                <td><input class="form-control" type="text" name="total" placeholder=""></td>
                <td><button class="btn btn-primary" type="button" id="agregar_btn"  >Agregar  </button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" id="guardar" > guardar </button>
</form>




</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#agregar_btn').on('click',function(){
            var html = '';
            html+='<tr>';
            html+='<td><input class="form-control" type="text" name="num_detalle" placeholder=""></td>';
            html+='<td><input class="form-control" type="text" name="cod_producto" placeholder=""></td>';
            html+='<td><input class="form-control" type="text" name="cantidad" placeholder=""></td>';
            html+='<td><input class="form-control" type="text" name="orden_trabajo" placeholder=""></td>';
            html+='<td><input class="form-control" type="text" name="valor" placeholder=""></td>';
            html+='<td><input class="form-control" type="text" name="total" placeholder=""></td>';
            html+='<td><button class="btn btn-primary" id="borrar_btn" type="button"> Eliminar </button></td>';
            html+='<tr>';       
            $('tbody').append(html);
        })
    });

    $(document).on('click','#borrar_btn',function(){
        $(this).closest('tr').remove();
    });

</script>
@endsection

