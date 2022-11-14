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
		<h5 style="text-align:center;"> CREACION DE PRODUCTOS</h5>
	</div>
	<div  style="width:100%" >

		<form  class="form-inline" type="get" action="{{ url('/almacenar-producto') }}" enctype="multipart/form-data">
			<div class="card border-primary mb-3">
				{{ csrf_field() }}
				<div class="row">
					<br>
					<div class="mb-3 col-md-3">
						<h6> Seleccione bodega </h6>
						<select style="width : 300px" class="form-control" id="cod_bod_producto" name="cod_bod_producto" placeholder="Ingrese sucursal" required style="max-width:10%;">
							@foreach($bodega as $nombrebodegas)
							<option value="{{$nombrebodegas->codigo_bodega}}">{{$nombrebodegas->nombre_bodega}} </option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row">
					<br>
					<div class="mb-3 col-md-3"> 
						<h6 for="codigo_producto">Código Producto</h6>
						<input  style="text-transform:uppercase" type="text" class="form-control" id="codigo_producto" name="codigo_producto" onblur="traerProducto()" minlength="1" maxlength="150" required onkeyup="javascript:this.value=this.value.toUpperCase();">

					</div>	
					<div class="mb-3 col-md-7">
						<h6 for="nombre_producto">Nombre Producto</h6>
						<input  style="text-transform:uppercase" type="text" class="form-control" id="nombre_producto" name="nombre_producto" required maxlength="100" onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
				</div>

				<input value="{{$userId = Auth::user()->name;}}" type="hidden" name="usuario">

				<div class="row">
					<br>
					<div class="mb-3 col-md-10">
						<h6> Observaciones productos </h6>
						<input  style="text-transform:uppercase" type="text" class="form-control" id="observacion_producto" name="observacion_producto"  maxlength="100" onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>

				</div>
				
				<div class="row mb-0">
					<br>
					<div class="col-md-6 offset-md-0">
						<br>
						<input type="submit" style="width:40%" class="btn btn-outline-primary"  value=" Grabar producto ">  </input>
					</div>
				</div>
			</div>
		</form>
	</div>

	<script type="text/javascript">
		function traerProducto() 
		{
			var codigo_bodega=$('#cod_bod_producto option:selected').val();
			var codigo_producto=$('#codigo_producto').val();
			console.log(codigo_bodega,codigo_producto);

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});	

			$.ajax({
         type:"GET", // la variable type guarda el tipo de la peticion GET,POST,..
         url:"/traer-producto", //url guarda la ruta hacia donde se hace la peticion
         data:{
         	"cod_bodega":codigo_bodega,
         	"cod_producto":codigo_producto
         }, // data recive un objeto con la informacion que se enviara al servidor
         success:function(data){ //success es una funcion que se utiliza si el servidor retorna informacion
         	console.log(data);
         	$('#nombre_producto').val(data.nombre_producto);
         	$('#observacion_producto').val(data.observacion_producto);
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


