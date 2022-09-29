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
	<div  style="width:100%" >
		<form class="form-inline" type="get" action="{{ url('/actualizar-bodega') }}">
			<div class="card border-warning mb-3">
				{{ csrf_field() }}   

				<div class="row">
					<div class="mb-3 col-md-3"> 
						<label for="codigo_bodega">Código Bodega</label>
						<input value="{{$bodega->codigo_bodega}}" type="text" class="form-control" id="codigo_bodega" name="codigo_bodega" placeholder="Ingrese codigo" minlength="1" maxlength="6" required readonly>
						<small id="cod_bod" class="form-text text-muted">con este codigo identificaras la bodega.</small>
					</div>


					<input value="{{$bodega->id}}" type="hidden" name="id">



					<div class="mb-3 col-md-6"> 
						<label for="nombre_bodega">Nombre Bodega</label>
						<input value="{{$bodega->nombre_bodega}}" type="text" class="form-control" id="nombre_bodega" name="nombre_bodega" placeholder="Ingrese nombre" required maxlength="50" >
						<small id="nom_bod" class="form-text text-muted">con este nombre identificaras la bodega.</small>
					</div>
				</div>

				<div class="row">
					<div class="mb-3 col-md-6"> 
						<label for="direccion_bodega">Dirección Bodega</label>
						<input value="{{$bodega->direccion_bodega}}" type="text" class="form-control" id="direccion_bodega" name="direccion_bodega" placeholder="Ingrese la direccion bodega" required>
						<small id="dir_bod" class="form-text text-muted">dirección de la bodega bodega.</small>
					</div>


					<div class="mb-3 col-md-4">
						<label for="comuna_bodega">Sucursal Bodega</label>
						<select class="form-control" id="sucursal_bodega" name="comuna_bodega" placeholder="Seleccione comuna bodega" required>
							<option value="{{$bodega->comuna_bodega}}">{{$bodega->comuna_bodega}}</option>
							@foreach($comuna as $comunas)

							<option value="{{$comunas->comuna_bodega}}">{{$comunas->comuna_bodega}} </option>

							@endforeach
						</select> 
					</div>
				</div>
				<div class="row mb-0">
					<div class="col-md-6 offset-md-0">

						<input type="submit" style="width:40%" class="btn btn-outline-warning" value="Actualizar bodega">  </input>
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


