

<style>
    @page {
      margin: 0cm 0cm;
      font-family: Arial;
  }

  label {
      font-size: 12px;
  }

  textarea {
    font-size: 12px;
}



td {
    font-size:10px;

}

th {
  font-size: 15px;

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


<div class="container">

    <label> Ingenieria de transportes</label>
    <br>
    <label>  JAVIER CORTES </label>


    <h3 style="text-align:center"> Orden de trabajo </h3>

    


    <label> SOLICITANTE {{$ot->nombres}} , RUT:{{$ot->solicitante}}</label>    
    <br>

    <label>{{$ot->nombre_bodega}} ,CODIGO:{{$ot->cod_bodega}} </label>      

    <label style="float: right"> FOLIO {{$ot->num_documento}}  </label >

    <br>

    <label> FECHA {{$ot->fecha}} </label >
    <br>    
    <label> ESTADO: {{$ot->estado}} </label >
    <br>

    


    <label> PATENTE: {{$ot->patente}}  </label>

    <label> KILOMETRAJE: {{$ot->kilometraje}}  </label>
    <br>
    <label> TIPO VEHICULO:  {{$ot->tipo_equipo}}</label >
    <br>
    <label> MARCA:  {{$ot->marca}}</label>

    <label> MODELO: {{$ot->modelo}} </label>

    <label> AÑO: {{$ot->anio}} </label>


    <div class="card border-primary mb-3"> 
        <div class="card-body">

           <table class="table table-bordered" id="tablaEmpleados" style="width:100%">
              <thead>
                <h5> PERSONAL ASIGNADO</h5>
                <tr>
                    <th>EMPLEADO</th>
                    <th>RUT</th>
                    <th>CARGO</th>
                    <th>INICIO</th>
                    <th>TERMINO</th>
                    <th>DESCRIPCION</th>

                </tr>
            </thead>
            <tbody id="tbodyEmpleado">
                @foreach($otPersonal as $otPersonales) 
                <tr>
                    <td>{{$otPersonales->nombres}}</td>
                    <td>{{$otPersonales->rut}}</td>
                    <td>{{$otPersonales->cargo}}</td>
                    <td>{{$otPersonales->fecha_inicio}}</td>
                    <td>{{$otPersonales->fecha_termino}}</td>
                    <td>{{$otPersonales->detalle}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="card border-primary mb-3"> 
    <div class="card-body">
        <h5> DIAGNOSTICO </h5>
        <textarea style="text-transform:uppercase" type="text-center" class="form-control" id="diagnostico"  name="diganostico"  onkeyup="javascript:this.value=this.value.toUpperCase();" for="diagnostico">{{$ot->diagnostico}}</textarea>
    </div>
</div>

<div class="card border-primary mb-3"> 
    <div class="card-body">

     <table class="table table-sm" style="width:100%">
      <thead>
        <h5> PRESUPUESTO ASIGNADO</h5>
        <tr>
            <th >CODIGO PRODUCTO</th>
            <th>PRODUCTO</th>
            <th>CANTIDAD</th>
            <th>PRECIO UNITARIO</th>
        </tr>
    </thead>
    <tbody id="tbodyProductos" >
        @foreach($otProducto as $otProductos) 
        <tr>
            <td style="text-align:left;">{{$otProductos->cod_producto}}</td>
            <td style="text-align:left">{{$otProductos->producto}}</td>
            <td style="text-align:center">{{$otProductos->cantidad}}</td>
            <td style="text-align:right">${{$otProductos->precio}}</td>

        </tr>
        @endforeach
    </tbody>
</table>

</div>
<br>
<div class="card-body">
    <table class="table table-sm" style="width:100%" id="tableServicios">
      <thead>
        <tr>
            <th>SERVICIOS</th>
            <th>DESCRIPCION:</th>
            <th>VALOR:</th>

        </tr>
    </thead>
    <tbody id="tbodyServicios">
        @foreach($otServicio as $otServicios) 
        <tr>
            <td style="text-align:center">{{$otServicios->servicio}}</td>
            <td style="text-align:center">{{$otServicios->descripcion_servicio}}</td>
            <td style="text-align:right">{{$otServicios->valor_servicio}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
</div>


<h5> TRABAJOS REALIZADOS </h5>
<textarea style="text-transform:uppercase" type="text-center" class="form-control" id="trabajos_realizados"  name="trabajos_realizados"  onkeyup="javascript:this.value=this.value.toUpperCase();" >{{$ot->trabajos_realizados}}</textarea>


<h5> OBSERVACIONES SUPERVISOR </h5>
<textarea style="text-transform:uppercase" type="text-center" class="form-control" id="observaciones"  name="observaciones"  onkeyup="javascript:this.value=this.value.toUpperCase();" for="observaciones">{{$ot->observaciones}}</textarea>


</form>
</div>
