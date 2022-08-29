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
			<form class="form-inline" type="get" action="{{ url('/almacenar-proveedor') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="rut_proveedor">Rut</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="rut_proveedor" name="rut_proveedor" placeholder="Ingrese codigo" minlength="1" maxlength="150" required onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="rut_prov" class="form-text text-muted">rut del proveedor.</small>
				</div>
				<div class="form-group">
					<label for="dig_rut_prov">Digito verificador</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="dig_rut_prov" name="dig_rut_prov" placeholder="Ingrese codigo" minlength="1" maxlength="150" required onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="dig_rut_prov" class="form-text text-muted">rut del proveedor.</small>
				</div>

				<div class="form-group">
					<label for="razon_social">Razon social</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingrese razon social" required maxlength="100" onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="nom_bod" class="form-text text-muted">con este nombre identificaras al proveedor.</small>
				</div>

				<div class="form-group">
					<label for="giro">Giro</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="giro" name="giro" placeholder="Ingrese el giro del proveedor" required onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="dir_bod" class="form-text text-muted">giro del proveedor.</small>
				</div>
				<div class="form-group">
					<label for="direccion_prov">Dirección</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="direccion_prov" name="direccion_prov" placeholder="Ingrese la direccion del proveedor" required onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="dir_bod" class="form-text text-muted">direccion del proveedor.</small>
				</div>
				<div class="form-group">
					<label for="comuna_prov">Comuna</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="comuna_prov" name="comuna_prov" placeholder="Ingrese la comuna del proveedor" required onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="dir_bod" class="form-text text-muted">comuna del proveedor </small>
				</div>
				<div class="form-group">
					<label for="ciudad_prov">Ciudad</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="ciudad_prov" name="ciudad_prov" placeholder="Ingrese la ciudad del proveedor " required onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="dir_bod" class="form-text text-muted">ciudad del proveedor.</small>
				</div>
				<div class="form-group">
					<label for="banco">Banco</label>
					<select class="form-control" id="banco" name="banco" placeholder="Seleccione su banco">
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
					<small id="dir_bod" class="form-text text-muted">Nombre del banco.</small>
				</div>





				<div class="form-group">
					<label for="tipo_cuenta">Tipo de cuenta</label>
					<select class="form-control" id="tipo_cuenta" name="tipo_cuenta" placeholder="Ingrese tipo de cuenta">
						<option value="CUENTA CORRIENTE">CUENTA CORRIENTE</option>
						<option value="CUENTA VISTA">CUENTA VISTA</option>
						<option value="CUENTA AHORRO">CUENTA AHORRO</option>
					</select> 
					<small id="dir_bod" class="form-text text-muted">Seleccione sucursal.</small>
				</div>

				<div class="form-group">
					<label for="n_cta_prov">Cuenta bancaria</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="n_cta_prov" name="n_cta_prov" placeholder="Ingrese el numero de cuenta" onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="dir_bod" class="form-text text-muted">numero de la cuenta</small>
				</div>
				<div class="form-group">
					<label for="telefono_prov">Telefono proveedor</label>
					<input style="text-transform:uppercase" type="text" class="form-control" id="telefono_prov" name="telefono_prov" placeholder="Ingrese el numero de cuenta" onkeyup="javascript:this.value=this.value.toUpperCase();">
					<small id="dir_bod" class="form-text text-muted">numero de la cuenta</small>
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


