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
		<form class="form-inline" type="get" action="{{ url('/actualizar-empleado') }}">
			<div class="card border-warning mb-3">
				{{ csrf_field() }}   

				<input value="{{$empleado->id}}" type="hidden" name="id">

				<div class="mb-3 col-md-2"> 
					<h6  for="codigo_bodega">Rut Empleado</h6>
					<input style="text-transform:uppercase" value="{{$empleado->rut}} " type="text" class="form-control" id="rut" name="rut" minlength="1" maxlength="12" required  onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small class="form-text text-muted">Formato 11.111.111-1</small>
				</div>

				<div class="mb-3 col-md-5"> 
					<h6 for="nombre_bodega">Nombre Completo</h6>
					<input style="text-transform:uppercase"  value="{{$empleado->nombres}}"  type="text" class="form-control" id="nombres" name="nombres" required maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				
				<input value="{{$userId = Auth::user()->name;}}" type="hidden" name="usuario">


				<div class="mb-3 col-md-4"> 
					<h6 for="direccion_bodega">Cargo</h6>
					<input style="text-transform:uppercase" value="{{$empleado->cargo}}" type="text" class="form-control" id="cargo" name="cargo" required onkeyup="javascript:this.value=this.value.toUpperCase();"> 
				</div>


				<div class="row mb-0">
					<div class="col-md-6 offset-md-0">

						<input type="submit" style="width:40%" class="btn btn-outline-warning" value="Actualizar Empleado">  </input>
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


