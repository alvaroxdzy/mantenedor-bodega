<div class="modal modal-blur fade" id="show--modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> PRUEBA
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<table id="myTable" class="table table-sm "  style="width:100%" >
					<thead >
						<tr>
							<th>Rut</th>
							<th>Razón</th>
							<th>Giro</th>
							<th>Dirección</th>
						</thead>
						<tbody>
						</tr>
						@foreach($proveedor as $proveedores) 
						<tr>
							<td id="td-datatable">{{$proveedores->rut_proveedor}}-{{$proveedores->dig_rut_prov}} </td>
							<td id="td-datatable">{{$proveedores->razon_social}}</td>
							<td id="td-datatable">{{$proveedores->giro}}</td>
							<td id="td-datatable">{{$proveedores->direccion_prov}}</td>
						</tr>
						@endforeach
					</tbody>
				</table> 
			</div>

		</div>
	</div>
</div>



<div class="col-md-4">
	<div class="mb-4 d-flex justify-content-end">
		<a class="btn btn-primary" href="{{ URL::to('#') }}">Convertir a PDF</a>
	</div>
</div>