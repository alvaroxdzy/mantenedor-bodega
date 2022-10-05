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
		<h5 style="text-align:center;"> CREACION DE BODEGA</h5>
	</div>
	<div  style="width:100%" >
		<form class="form-inline" type="get" action="{{ url('/almacenar-bodega') }}">
			<div class="card border-primary mb-3">

				{{ csrf_field() }}
				<div class="row">
					<div class="mb-3 col-md-3"> 
						<h6  for="codigo_bodega">Código Bodega</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="codigo_bodega" name="codigo_bodega" minlength="1" maxlength="5" required  onkeyup="javascript:this.value=this.value.toUpperCase();">
						<small id="cod_bod" class="form-text text-muted">con este codigo identificaras la bodega.</small>
					</div>

					<div class="mb-3 col-md-6"> 
						<h6 for="nombre_bodega">Nombre Bodega</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="nombre_bodega" name="nombre_bodega" required maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();">
						<small id="nom_bod" class="form-text text-muted">con este nombre identificaras la bodega.</small>
					</div>
				</div>


				<input value="{{$userId = Auth::user()->name;}}" type="hidden" name="usuario">
				<div class="row">
					<div class="mb-3 col-md-6"> 
						<h6 for="direccion_bodega">Dirección Bodega</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="direccion_bodega" name="direccion_bodega" required onkeyup="javascript:this.value=this.value.toUpperCase();"> 
						<small id="dir_bod" class="form-text text-muted">dirección de la bodega.</small>
					</div>

					<div class="mb-3 col-md-4"> 
						<h6 for="sucursal_bodega">Comuna Bodega</h6>
						<select  class="form-control" id="comuna_bodega" name="comuna_bodega" placeholder="seleccione comuna" required>
							<option value="SANTIAGO , REGION METROPOLITANA">SANTIAGO , REGION METROPOLITANA </option>
							<option value="LA CHIMBA , ANTOFAGASTA">LA CHIMBA , ANTOFAGASTA  </option>
						</select> 
					</div>
				</div>
				<div class="row mb-0">
					<div class="col-md-6 offset-md-0">

						<input type="submit"  style="width:40%" class="btn btn-outline-primary"  value="Crear bodega "> </input>
					</div>
				</div>
			</div>
		</form>

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


