@extends('layouts.app')
<style type="text/css">
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

/* Firefox */
input[type=number] {
	-moz-appearance: textfield;
}
</style>

@section('content')

<div class="container">
	<div class="card border-primary mb-3">
		<h5 style="text-align:center;"> CREACION DE PROVEEDORES</h5>
	</div>
	<div  style="width:100%" >
		<form class="form-inline" type="get" action="{{ url('/almacenar-proveedor') }}">
			<div class="card border-primary mb-3">
				{{ csrf_field() }}
				<div class="row" > 
					<div class="mb-3 col-md-2">
						<label for="rut_proveedor">Rut</label>
						<input style="width:200px" style="text-transform:uppercase" type="text" class="form-control" id="rut_proveedor" name="rut_proveedor" minlength="1" maxlength="20" onblur="traerProveedor()" required onkeyup="javascript:this.value=this.value.toUpperCase();">
						<small id="rut_prov" class="form-text text-muted">11111111-1.</small>
					</div>
					
					<div class="mb-3 col-md-3">
						<label for="razon_social">Razon social</label>
						<input style="text-transform:uppercase" type="text" class="form-control" id="razon_social" name="razon_social" required maxlength="75" onkeyup="javascript:this.value=this.value.toUpperCase();">

					</div>

					<div class="mb-3 col-md-3">
						<label for="giro">Giro</label>
						<input style="text-transform:uppercase" type="text" class="form-control" id="giro" name="giro"  required onkeyup="javascript:this.value=this.value.toUpperCase();">

					</div>
				</div>
				<br> 
				<div class="row" >
					<div class="mb-3 col-md-8">
						<label for="direccion_prov">Dirección</label>
						<input style="text-transform:uppercase" type="text" class="form-control" id="direccion_prov" name="direccion_prov" required onkeyup="javascript:this.value=this.value.toUpperCase();">
				
					</div>
				</div>

				<div class="row mb-0">
					<div class="col-md-6 offset-md-0">
						<br>
						<input type="submit"  style="width:30%;" class="btn btn-outline-primary"  value=" Grabaar Proveedor "> </input>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	function traerProveedor() 
	{
		var rut_proveedor=$('#rut_proveedor').val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});	

		$.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/traer-proveedor", //url guarda la ruta hacia donde se hace la peticion
         data:{
         	"rut_proveedor":rut_proveedor
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
         	console.log(data);
         	$('#razon_social').val(data.razon_social);
         	$('#giro').val(data.giro);
         	$('#direccion_prov').val(data.direccion_prov);

         },
     });
	}
</script>



<div id="error"> </div>
@if(session()->has('message'))
<div class="alert alert-success">
	{{ session()->get('message') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
	{{ session()->get('error') }}
</div>
@endif

</div>
@endsection


