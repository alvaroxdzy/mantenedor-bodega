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
		<h5 style="text-align:center;"> MODIFICACION DE PROVEEDORES</h5>
	</div>
	<div class="row mb-3">
		<div class="col-xl-12"> 
			<div  style="width:100%" >
				<form class="form-inline" type="get" action="{{ url('/actualizar-proveedor') }}">
					<div class="card border-primary mb-3">
						{{ csrf_field() }}    
						<div class="row" > 
							<div class="mb-3 col-md-2">
								<label for="rut_proveedor">Rut</label>
								<input value="{{$proveedor->rut_proveedor}}"  style="width:200px" style="text-transform:uppercase" type="text" class="form-control" id="rut_proveedor" name="rut_proveedor" minlength="1" maxlength="20" required onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>

							</div>

							<input value="{{$proveedor->id}}" type="hidden" name="id">


							<div class="mb-3 col-md-2">
								<label for="dig_rut_prov">Digito verificador</label>
								<input value="{{$proveedor->dig_rut_prov}}" style="width:50px"style="text-transform:uppercase" type="text" class="form-control" id="dig_rut_prov" name="dig_rut_prov"  minlength="1" maxlength="1" required onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>

							</div>
							<div class="mb-3 col-md-3">
								<label for="razon_social">Razon social</label>
								<input value="{{$proveedor->razon_social}}" style="text-transform:uppercase" type="text" class="form-control" id="razon_social" name="razon_social" required maxlength="75" onkeyup="javascript:this.value=this.value.toUpperCase();">

							</div>

							<div class="mb-3 col-md-3">
								<label for="giro">Giro</label>
								<input value="{{$proveedor->giro}}" style="text-transform:uppercase" type="text" class="form-control" id="giro" name="giro"  required onkeyup="javascript:this.value=this.value.toUpperCase();">
								
							</div>
						</div>
						<br> 
						<div class="row" >
							<div class="mb-3 col-md-8">
								<label for="direccion_prov">Dirección</label>
								<input value="{{$proveedor->direccion_prov}}" style="text-transform:uppercase" type="text" class="form-control" id="direccion_prov" name="direccion_prov" required onkeyup="javascript:this.value=this.value.toUpperCase();">
							
							</div>

						</div>

						<div class="row mb-0">
							<div class="col-md-8 offset-md-0">
								<input type="submit" class="btn btn-outline-primary"  value="Actualizar proveedor"> </input>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
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



