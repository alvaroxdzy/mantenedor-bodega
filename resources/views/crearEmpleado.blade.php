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
		<h5 style="text-align:center;"> REGISTRAR EMPLEADO</h5>
	</div>
	<div  style="width:100%" >
		<form class="form-inline" type="get" action="{{ url('/almacenar-empleado') }}">
			<div class="card border-primary mb-3">

				{{ csrf_field() }}
				
				<div class="mb-3 col-md-5"> 
					<h6  for="codigo_bodega">Rut Empleado</h6>
					<input style="text-transform:uppercase" type="text" class="form-control" id="rut" name="rut" minlength="1" maxlength="12" required onblur="traerEmpleado()"  onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="11111111-1">
				</div>

				<div class="mb-3 col-md-5"> 
					<h6 for="nombre_bodega">Nombre Completo</h6>
					<input style="text-transform:uppercase" type="text" class="form-control" id="nombres" name="nombres" required maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				
				<input value="{{$userId = Auth::user()->name;}}" type="hidden" name="usuario">


				<div class="mb-3 col-md-5"> 
					<h6 for="direccion_bodega">Cargo</h6>
					<input style="text-transform:uppercase" type="text" class="form-control" id="cargo" name="cargo" required onkeyup="javascript:this.value=this.value.toUpperCase();"> 
				</div>


				<div class="row mb-0">
					<div class="col-md-6 offset-md-0">

						<input type="submit" id="btn-crear" class="btn btn-primary"  value="Crear Empleado "> </input>
					</div>
				</div>
			</div>
		</form>

		<script type="text/javascript">
			function traerEmpleado() 
			{
				var rut=$('#rut').val();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});	

				$.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/traer-empleado", //url guarda la ruta hacia donde se hace la peticion
         data:{
         	"rut":rut
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
         	console.log(data);
         	$('#nombres').val(data.nombres);
         	$('#cargo').val(data.cargo);
         },
     });
			}
		</script>
		<style type="text/css">
			#btn-crear{
				padding: 3px;
			}
		</style>

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


