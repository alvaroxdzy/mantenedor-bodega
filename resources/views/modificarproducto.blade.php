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
			<form class="form-inline" type="get" action="{{ url('/actualizar-producto') }}">
				{{ csrf_field() }}    
				<div class="form-group">  
					<label for="codigo_bodega">Código Producto</label>
					<input value="{{$producto->codigo_producto}}" type="text" class="form-control" id="codigo_producto" name="codigo_producto" placeholder="Ingrese codigo" minlength="1" maxlength="6" required readonly>
					<small id="cod_bod" class="form-text text-muted">con este codigo identificaras el producto.</small>
				</div>


				<input value="{{$producto->id}}" type="hidden" name="id">



				<div class="form-group">
					<label for="nombre_producto">Nombre producto</label>
					<input value="{{$producto->nombre_producto}}" type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingrese nombre" required maxlength="50" >
					<small id="nom_bod" class="form-text text-muted">con este nombre identificaras al producto.</small>
				</div>
				<div class="form-group">
					<label for="observacion_producto">Observacion Producto</label>
					<input value="{{$producto->observacion_producto}}" type="text" class="form-control" id="observacion_producto" name="observacion_producto" placeholder="Ingrese detalles de producto" required>
					<small id="dir_bod" class="form-text text-muted">detalle productos.</small>
				</div>
				<div class="form-group">
					<label for="cod_bod_producto">Sucursal Bodega</label>
					<select class="form-control" id="cod_bod_producto" name="cod_bod_producto" placeholder="Ingrese sucursal" required>
						<option value="{{$producto->cod_bod_producto}}">{{$producto->cod_bod_producto}}</option>
						<option value="002">Antofagasta</option>
						<option value="001">Santiago</option>
					</select> 
				</div>
				<input type="submit" class="btn btn-primary"  value="Actualizar ">  </input>
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


