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
	<div class="row mb-3">
		<div class="col-xl-12"> 
			<br>
			<form class="form-inline" type="get" action="{{ url('/almacenar-bodega') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<h6  for="codigo_bodega">Código Bodega</h6>
					<input style="text-transform:uppercase" type="text" class="form-control" id="codigo_bodega" name="codigo_bodega" placeholder="Ingrese codigo" minlength="1" maxlength="5" required  onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="cod_bod" class="form-text text-muted">con este codigo identificaras la bodega.</small>
				</div>

				<div class="form-group">
					<h6 for="nombre_bodega">Nombre Bodega</h6>
					<input style="text-transform:uppercase" type="text" class="form-control" id="nombre_bodega" name="nombre_bodega" placeholder="Ingrese nombre" required maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="nom_bod" class="form-text text-muted">con este nombre identificaras la bodega.</small>
				</div>

				<div class="form-group">
					<h6 for="direccion_bodega">Dirección Bodega</h6>
					<input style="text-transform:uppercase" type="text" class="form-control" id="direccion_bodega" name="direccion_bodega" placeholder="Ingrese la direccion bodega" required onkeyup="javascript:this.value=this.value.toUpperCase();"> 
					<small id="dir_bod" class="form-text text-muted">dirección de la bodega.</small>
				</div>

				<div class="form-group">
					<h6 for="sucursal_bodega">Comuna Bodega</h6>
					<select  class="form-control" id="comuna_bodega" name="comuna_bodega" placeholder="seleccione comuna" required>
						<option value="SANTIAGO , REGION METROPOLITANA">SANTIAGO , REGION METROPOLITANA </option>
						<option value="LA CHIMBA , ANTOFAGASTA">LA CHIMBA , ANTOFAGASTA  </option>
					</select> 
				</div>

				<div class="form-group">
					<label for="telefono_bodega">Teléfono</label>
					<input style="text-transform:uppercase" type="tel" class="form-control" id="telefono_bodega" name="telefono_bodega" value=+56 minlength="8" maxlength="13" onkeyup="javascript:this.value=this.value.toUpperCase();"> 
					<small id="suc_bod" class="form-text text-muted">contacto de la bodega.</small>
				</div>

				<input type="submit" class="btn btn-primary"  value="Enviar "> </input>
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
</div>
@endsection


