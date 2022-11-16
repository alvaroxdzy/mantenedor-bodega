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
		<h5 style="text-align:center;"> GESTION DE VEHICULOS</h5>
	</div>
	<div  style="width:100%" >
		<form class="form-inline" type="get" action="{{ url('/actualizar-vehiculo') }}">
			<div class="card border-primary mb-3">

				{{ csrf_field() }}
				<div class="row">
					<div class="mb-3 col-md-2"> 
						<h6>PATENTE</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="patente" name="patente" minlength="2" maxlength="7" required  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->patente}}" readonly>
					</div>

					<div class="mb-3 col-md-3"> 
						<h6>TIPO CAMION</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="tipo_equipo" name="tipo_equipo" required maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->tipo_equipo}}">
					</div>
				</div>


				<div class="row">
					<div class="mb-3 col-md-3"> 
						<h6>MARCA</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="marca" name="marca" required onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->marca}}"> 
					</div>

					<div class="mb-3 col-md-3"> 
						<h6>MODELO</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="modelo" name="modelo" required onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->modelo}}"> 
					</div>
					<div class="mb-3 col-md-2"> 
						<h6>AÑO</h6>
						<input style="text-transform:uppercase" type="text" class="form-control" id="anio" name="anio" required onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->anio}}"> 
					</div>

					<div class="row mb-0">
						<div class="col-md-6 offset-md-0">

							<input type="submit"  style="width:40%" class="btn btn-outline-primary"  value="GRABAR VEHICULO "> </input>
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


