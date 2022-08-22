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
			<form class="form-inline" type="get" action="{{ url('/almacenarBodega') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="codigo_bodega">Código Bodega</label>
					<input type="text" class="form-control" id="codigo_bodega" name="codigo_bodega" placeholder="Ingrese codigo" minlength="1" maxlength="6" required >
					<small id="cod_bod" class="form-text text-muted">con este codigo identificaras la bodega.</small>
				</div>
				<div class="form-group">
					<label for="nombre_bodega">Nombre Bodega</label>
					<input type="text" class="form-control" id="nombre_bodega" name="nombre_bodega" placeholder="Ingrese nombre" required maxlength="50" >
					<small id="nom_bod" class="form-text text-muted">con este nombre identificaras la bodega.</small>
				</div>
				<div class="form-group">
					<label for="direccion_bodega">Dirección Bodega</label>
					<input type="text" class="form-control" id="direccion_bodega" name="direccion_bodega" placeholder="Ingrese la direccion bodega" required>
					<small id="dir_bod" class="form-text text-muted">dirección de la bodega bodega.</small>
				</div>
				<div class="form-group">
					<label for="sucursal_bodega">Sucursal Bodega</label>
					<select class="form-control" id="sucursal_bodega" name="sucursal_bodega" placeholder="Ingrese sucursal" required>
						<option value="Antofagasta">Antofagasta</option>
						<option value="Santiago">Santiago</option>
					</select> 

				</div>
				<div class="form-group">
					<label for="telefono_bodega">Teléfono</label>
					<input type="number" class="form-control" id="telefono_bodega" name="telefono_bodega" >
					<small id="suc_bod" class="form-text text-muted">Sin código de area.</small>
				</div>

				<input type="submit" class="btn btn-primary"  value="Enviar ">Enviar</input>
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


