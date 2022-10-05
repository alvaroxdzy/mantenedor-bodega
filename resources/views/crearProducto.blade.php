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
					<div class="mb-3 col-md-2"> 
						<h6 for="codigo_producto">Código Producto</h6>
						<input style="width : 200px" style="text-transform:uppercase" type="text" class="form-control" id="codigo_producto" name="codigo_producto"  minlength="1" maxlength="150" required onkeyup="javascript:this.value=this.value.toUpperCase();">

					</div>	
					<div class="mb-3 col-md-2">
						<h6 for="nombre_producto">Nombre Producto</h6>
						<input style="width : 500px" style="text-transform:uppercase" type="text" class="form-control" id="nombre_producto" name="nombre_producto" required maxlength="100" onkeyup="javascript:this.value=this.value.toUpperCase();">

					</div>
				</div>

				<input value="{{$userId = Auth::user()->name;}}" type="hidden" name="usuario">

				<div class="form-group">
					<h6> Observaciones productos </h6>
					<textarea style="text-transform:uppercase" type="text-center" class="form-control" id="observacion_producto"  name="observacion_producto"  required onkeyup="javascript:this.value=this.value.toUpperCase();" for="observacion_producto"></textarea>

				</div>
				<div class="row">
					<div class="mb-3 col-md-3">
						<h6> Seleccione bodega </h6>
						<select style="width : 300px" class="form-control" id="cod_bod_producto" name="cod_bod_producto" placeholder="Ingrese sucursal" required style="max-width:10%;">
							@foreach($bodega as $nombrebodegas)
							<option value="{{$nombrebodegas->codigo_bodega}}">{{$nombrebodegas->nombre_bodega}} </option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row mb-0">
					<div class="col-md-6 offset-md-0">
						<br>
						<input type="submit" style="width:40%" class="btn btn-outline-primary"  value="Crear producto ">  </input>
					</div>
				</div>
			</div>
		</form>
	</div>

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


