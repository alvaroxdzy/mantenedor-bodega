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
			<div  style="width:100%" >
				<form class="form-inline" type="get" action="{{ url('/actualizar-proveedor') }}">
					<div class="card border-warning mb-3">
						{{ csrf_field() }}    
						<div class="row" > 
							<div class="mb-3 col-md-2">
								<label for="rut_proveedor">Rut</label>
								<input value="{{$proveedor->rut_proveedor}}"  style="width:200px" style="text-transform:uppercase" type="text" class="form-control" id="rut_proveedor" name="rut_proveedor" minlength="1" maxlength="20" required onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
								<small id="rut_prov" class="form-text text-muted">ingrese rut sin codigo verificador.</small>
							</div>

							<input value="{{$proveedor->id}}" type="hidden" name="id">


							<div class="mb-3 col-md-2">
								<label for="dig_rut_prov">Digito verificador</label>
								<input value="{{$proveedor->dig_rut_prov}}" style="width:50px"style="text-transform:uppercase" type="text" class="form-control" id="dig_rut_prov" name="dig_rut_prov"  minlength="1" maxlength="1" required onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
								<small id="dig_rut_prov" class="form-text text-muted">digito verificador.</small>
							</div>
							<div class="mb-3 col-md-3">
								<label for="razon_social">Razon social</label>
								<input value="{{$proveedor->razon_social}}" style="text-transform:uppercase" type="text" class="form-control" id="razon_social" name="razon_social" required maxlength="75" onkeyup="javascript:this.value=this.value.toUpperCase();">
								<small id="nom_bod" class="form-text text-muted">razon social del proveedor.</small>
							</div>

							<div class="mb-3 col-md-3">
								<label for="giro">Giro</label>
								<input value="{{$proveedor->giro}}" style="text-transform:uppercase" type="text" class="form-control" id="giro" name="giro"  required onkeyup="javascript:this.value=this.value.toUpperCase();">
								<small id="dir_bod" class="form-text text-muted">giro del proveedor.</small>
							</div>
						</div>
						<br> 
						<div class="row" >
							<div class="mb-3 col-md-8">
								<label for="direccion_prov">Dirección</label>
								<input value="{{$proveedor->direccion_prov}}" style="text-transform:uppercase" type="text" class="form-control" id="direccion_prov" name="direccion_prov" required onkeyup="javascript:this.value=this.value.toUpperCase();">
								<small id="dir_bod" class="form-text text-muted"> direccion del proveedor.</small>
							</div>

						</div>
						<br>


						<div class="row" > 
							<div class="mb-3 col-md-4">
								<label for="banco">Banco</label>
								<select class="form-control" id="banco" name="banco" >
									<option hidden value="{{$proveedor->banco}}">{{$proveedor->banco}}</option>
									<option value="BANCO CHILE-EDWARDS-CITI">BANCO CHILE-EDWARDS-CITI</option>
									<option value="BANCO INTERNACIONAL">BANCO INTERNACIONAL</option>
									<option value="BANCO ESTADO">BANCO ESTADO</option>
									<option value="BANCO SCOTIABANK">BANCO SCOTIABANK</option>
									<option value="BCI">BCI</option>
									<option value="BANCO DO BRASIL S.A.">BANCO DO BRASIL S.A.</option>
									<option value="CORPBANCA">CORPBANCA</option>
									<option value="BANCO BICE">BANCO BICE</option>
									<option value="REPUBLIC NATIONAL BANK OF N.Y.">REPUBLIC NATIONAL BANK OF N.Y.</option>
									<option value="BANCO SANTANDER">BANCO SANTANDER</option>
									<option value="BANCO ITAU">BANCO ITAU</option>
									<option value="THE CHASE MANHATTAN BANK N.A.">THE CHASE MANHATTAN BANK N.A.</option>
									<option value="BANCO SECURITY">BANCO SECURITY</option>
									<option value="BANCO FALABELLA">BANCO FALABELLA</option>
									<option value="BANCO RIPLEY">BANCO RIPLEY</option>
									<option value="RABOBANK">RABOBANK</option>
									<option value="BANCO CONSORCIO">BANCO CONSORCIO</option>
									<option value="BANCO PARIS">BANCO PARIS</option>
									<option value="BANCO BBVA">BANCO BBVA</option>
									<option value="BANCO DEL DESARROLLO">BANCO DEL DESARROLLO</option>
									<option value="COOPEUCH">COOPEUCH</option>
									<option value="PREPAGO LOS HEROES">PREPAGO LOS HEROES</option>
									<option value="TENPO PREGAGO">TENPO PREGAGO</option>
								</select> 
								<small id="dir_bod" class="form-text text-muted">Seleccione su banco.</small>
							</div>


							<div class="mb-3 col-md-4">
								<label for="tipo_cuenta">Tipo de cuenta</label>
								<select class="form-control" id="tipo_cuenta" name="tipo_cuenta" placeholder="Ingrese tipo de cuenta">
									<option hidden value="{{$proveedor->tipo_cuenta}}">{{$proveedor->tipo_cuenta}}</option>
									<option value="CUENTA CORRIENTE">CUENTA CORRIENTE</option>
									<option value="CUENTA_VISTA">CUENTA VISTA</option>
									<option value="CUENTA AHORRO">CUENTA AHORRO</option>
								</select> 
								<small id="dir_bod" class="form-text text-muted">Seleccione sucursal.</small>
							</div>

							<div class="mb-3 col-md-4">
								<label for="n_cta_prov">Cuenta bancaria</label>
								<input value="{{$proveedor->n_cta_prov}}" style="text-transform:uppercase" type="text" class="form-control" id="n_cta_prov" name="n_cta_prov"  onkeyup="javascript:this.value=this.value.toUpperCase();">
								<small id="dir_bod" class="form-text text-muted">numero de la cuenta</small>
							</div>
						</div>
						<br>
						<div class="row mb-0">
                        <div class="col-md-8 offset-md-0">
						<input type="submit" class="btn btn-outline-warning"  value="Actualizar proveedor"> </input>
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



