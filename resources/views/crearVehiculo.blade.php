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
		<h5 style="text-align:center;"> GESTION DE VEHICULOS</h5>
	</div>
	<div  style="width:100%" >
		<form class="form-inline" type="get" action="{{ url('/almacenar-vehiculo') }}">
			<div class="card border-primary mb-3">

				{{ csrf_field() }}
				<div class="row">
					<div class="mb-3 col-md-2"> 
						<h6>PATENTE</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="patente" name="patente" minlength="2" maxlength="7" required  onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="traerPatente()">
					</div>

					<div class="mb-3 col-md-3"> 
						<h6>TIPO CAMION</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="tipo_camion" name="tipo_camion" required maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
				</div>


				<div class="row">
					<div class="mb-3 col-md-3"> 
						<h6>MARCA</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="marca" name="marca" required onkeyup="javascript:this.value=this.value.toUpperCase();"> 
					</div>

					<div class="mb-3 col-md-3"> 
						<h6>MODELO</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="modelo" name="modelo" required onkeyup="javascript:this.value=this.value.toUpperCase();"> 
					</div>
					<div class="mb-3 col-md-2"> 
						<h6>AÑO</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="anio" name="anio" required onkeyup="javascript:this.value=this.value.toUpperCase();"> 
					</div>

					<div class="row mb-0">
						<div class="col-md-6 offset-md-0">

							<input type="submit"  style="width:40%" class="btn btn-outline-primary"  value="GRABAR VEHICULO "> </input>
						</div>
					</div>
				</div>
			</form>

<script type="text/javascript">
	function traerPatente() 
	{
		var patente=$('#patente').val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});	

		$.ajax({
     type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
     url:"/traer-vehiculo", //url guarda la ruta hacia donde se hace la peticion
     data:{
     	"patente":patente
     }, // data recive un objeto con la informacion que se enviara al servidor
     success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion

     	$('#tipo_camion').val(data.tipo_camion);
     	$('#marca').val(data.marca);
     	$('#modelo').val(data.modelo);
     	$('#anio').val(data.anio);
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
	</div>
	@endsection


