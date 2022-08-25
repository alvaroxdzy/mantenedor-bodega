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
			<form class="form-inline" type="get" action="{{ url('/actualizar-proveedor') }}">
				{{ csrf_field() }}    
				<div class="form-group">
					<label for="rut_proveedor">Rut</label>
					<input value="{{$proveedor->rut_proveedor}}" type="text" class="form-control" id="rut_proveedor" name="rut_proveedor" placeholder="Ingrese codigo" minlength="1" maxlength="150" required readonly >
					<small id="rut_prov" class="form-text text-muted">rut del proveedor.</small>
				</div>

				<input value="{{$proveedor->id}}" type="hidden" name="id">


				<div class="form-group">
					<label for="dig_rut_prov">Digito verificador</label>
					<input value="{{$proveedor->dig_rut_prov}}" type="text" class="form-control" id="dig_rut_prov" name="dig_rut_prov" placeholder="Ingrese codigo" minlength="1" maxlength="150" required >
					<small id="dig_rut_prov" class="form-text text-muted">rut del proveedor.</small>
				</div>

				<div class="form-group">
					<label for="razon_social">Razon social</label>
					<input value="{{$proveedor->razon_social}}" type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingrese razon social" required maxlength="100" >
					<small id="nom_bod" class="form-text text-muted">con este nombre identificaras al proveedor.</small>
				</div>

				<div class="form-group">
					<label for="giro">Giro</label>
					<input value="{{$proveedor->giro}}" type="text" class="form-control" id="giro" name="giro" placeholder="Ingrese el giro del proveedor" required>
					<small id="dir_bod" class="form-text text-muted">giro del proveedor.</small>
				</div>
				<div class="form-group">
					<label for="direccion_prov">Dirección</label>
					<input value="{{$proveedor->direccion_prov}}" type="text" class="form-control" id="direccion_prov" name="direccion_prov" placeholder="Ingrese la direccion del proveedor" required>
					<small id="dir_bod" class="form-text text-muted">direccion del proveedor.</small>
				</div>
				<div class="form-group">
					<label for="comuna_prov">Comuna</label>
					<input value="{{$proveedor->comuna_prov}}" type="text" class="form-control" id="comuna_prov" name="comuna_prov" placeholder="Ingrese la comuna del proveedor" required>
					<small id="dir_bod" class="form-text text-muted">comuna del proveedor </small>
				</div>
				<div class="form-group">
					<label for="ciudad_prov">Ciudad</label>
					<input value="{{$proveedor->ciudad_prov}}" type="text" class="form-control" id="ciudad_prov" name="ciudad_prov" placeholder="Ingrese la ciudad del proveedor " required>
					<small id="dir_bod" class="form-text text-muted">ciudad del proveedor.</small>
				</div>
				<div class="form-group">
					<label for="banco">Banco</label>
					<input value="{{$proveedor->banco}}" type="text" class="form-control" id="banco" name="banco" placeholder="Nombre del banco" >
					<small id="dir_bod" class="form-text text-muted">Nombre del banco.</small>
				</div>


				<div class="form-group">
					<label for="tipo_cuenta">Tipo de cuenta</label>
					<select class="form-control" id="tipo_cuenta" name="tipo_cuenta" placeholder="Ingrese tipo de cuenta">
						<option value="{{$proveedor->tipo_cuenta}}">{{$proveedor->tipo_cuenta}}</option>
						<option value="cuenta corriente">Cuenta corriente</option>
						<option value="cuenta vista">Cuenta vista</option>
						<option value="cuenta ahorro">Cuenta ahorro</option>
					</select> 
					<small id="dir_bod" class="form-text text-muted">Seleccione sucursal.</small>
				</div>

				<div class="form-group">
					<label for="n_cta_prov">Cuenta bancaria</label>
					<input value="{{$proveedor->n_cta_prov}}" type="text" class="form-control" id="n_cta_prov" name="n_cta_prov" placeholder="Ingrese el numero de cuenta" >
					<small id="dir_bod" class="form-text text-muted">numero de la cuenta</small>
				</div>
				<div class="form-group">
					<label for="telefono_prov">Telefono proveedor</label>
					<input value="{{$proveedor->telefono_prov}}" type="text" class="form-control" id="telefono_prov" name="telefono_prov" placeholder="Ingrese el numero de cuenta" >
					<small id="dir_bod" class="form-text text-muted">telefono proveedor</small>
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


