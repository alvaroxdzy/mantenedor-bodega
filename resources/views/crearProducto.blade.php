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
					<input style="text-transform:uppercase" type="text" class="form-control" id="codigo_producto" name="codigo_producto" placeholder="Ingrese codigo" minlength="1" maxlength="150" required onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="cod_bod" class="form-text text-muted">con este codigo identificaras el producto.</small>
				</div>
				<div class="form-group">
					<label for="nombre_producto">Nombre Producto</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingrese nombre" required maxlength="100" onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="nom_bod" class="form-text text-muted">con este nombre identificaras el producto.</small>
				</div>
				<div class="form-group">
					<label for="observacion_producto">Observaciones Producto</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="observacion_producto" name="observacion_producto" placeholder="Ingrese la observacion producto" required onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="dir_bod" class="form-text text-muted">detalles de los productos.</small>
				</div>

				<div class="form-group">
					<label> Seleccione sucursal bodega </label>
					<select class="form-control" id="cod_bod_producto" name="cod_bod_producto" placeholder="Ingrese sucursal" required >
						@foreach($bodega as $bodeguita)

						<option value="{{$bodeguita->codigo_bodega}}">{{$bodeguita->comuna_bodega}} </option>

						@endforeach

					</select>
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


