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

	<br>
	<form class="form-inline" type="get" action="{{ url('/actualizar-producto') }}">
		{{ csrf_field() }}    
		<div class="row">
			<div class="mb-3 col-md-2"> 
				<h6 for="codigo_producto">Código Producto</h6>
				<input style="width : 200px" value="{{$producto->codigo_producto}}" type="text" class="form-control" id="codigo_producto" name="codigo_producto" placeholder="Ingrese codigo" minlength="1" maxlength="6" required readonly>
				<small id="cod_bod" class="form-text text-muted">Ingrese codigo producto.</small>
			</div>

			<input value="{{$producto->id}}" type="hidden" name="id">

			<div class="mb-3 col-md-2">
				<h6 for="nombre_producto">Nombre Producto</h6>
				<input style="text-transform:uppercase" style="width : 500px" value="{{$producto->nombre_producto}}" type="text" class="form-control" id="nombre_producto" name="nombre_producto" onkeyup="javascript:this.value=this.value.toUpperCase();" required maxlength="50" >
				<small id="nom_bod" class="form-text text-muted">Ingrese nombre del producto.</small>
			</div>

			<div class="form-group">
				<h6 for="observacion_producto">Observacion Producto</h6>
				<textarea value="{{$producto->observacion_producto}}" style="text-transform:uppercase" type="text" class="form-control" id="observacion_producto"  name="observacion_producto" placeholder="Ingrese los detalles del producto" required onkeyup="javascript:this.value=this.value.toUpperCase();" for="observacion_producto"> {{$producto->observacion_producto}} </textarea>
				<small id="dir_bod" class="form-text text-muted">Ingrese detalles del producto.</small>
			</div>


			<div class="form-group">
				<label for="cod_bod_producto">Seleccione Bodega</label>
				<select style="width : 300px" class="form-control" id="cod_bod_producto" name="cod_bod_producto" placeholder="Ingrese sucursal" required>
					<option hidden value="{{$cod_bodega->codigo_bodega}}">  {{$cod_bodega->nombre_bodega}}  </option>
					@foreach($nombre_bodega as $nombre_bodegas)
					<option value="{{$nombre_bodegas->codigo_bodega}}">{{$nombre_bodegas->nombre_bodega}}</option>
					@endforeach 
				</select> 
				<small class="form-text text-muted"> Seleecione la bodega en la que se encuentra el producto</small>
				<br>
				<br>
			</div>


			<input style="width : 300px" type="submit" class="btn btn-primary"  value="Actualizar ">  </input>
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
	@endsection


