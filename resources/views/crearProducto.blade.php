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
			<form class="form-inline" type="get" action="{{ url('/almacenar-producto') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="codigo_producto">Código Producto</label>
					<input type="text" class="form-control" id="codigo_producto" name="codigo_producto" placeholder="Ingrese codigo" minlength="1" maxlength="150" required >
					<small id="cod_bod" class="form-text text-muted">con este codigo identificaras el producto.</small>
				</div>
				<div class="form-group">
					<label for="nombre_producto">Nombre Producto</label>
					<input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingrese nombre" required maxlength="100" >
					<small id="nom_bod" class="form-text text-muted">con este nombre identificaras el producto.</small>
				</div>
				<div class="form-group">
					<label for="observacion_producto">Observaciones Producto</label>
					<input type="text" class="form-control" id="observacion_producto" name="observacion_producto" placeholder="Ingrese la observacion producto" required>
					<small id="dir_bod" class="form-text text-muted">detalles de los productos.</small>
				</div>
				<div class="form-group">
					<label for="cod_bod_producto">Sucursal Bodega</label>
					<select class="form-control" id="cod_bod_producto" name="cod_bod_producto" placeholder="Ingrese sucursal" required>
						<option value="002">Antofagasta</option>
						<option value="001">Santiago</option>
					</select> 
					<small id="dir_bod" class="form-text text-muted">Seleccione sucursal.</small>
				</div>      
				<input type="submit" class="btn btn-primary"  value="Enviar "> Guardar </input>
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


