@extends('layouts.app')

@section('content')



<div  class="container"> 
  <br/>
  <h4>Proveedores</h4>
  <div id="div-buscar-proveedor" class=""> 
   <form class="form-text-input" type="get" action="{{ url('/busqueda-proveedores') }}">

     <input class="form-text-input" placeholder=" 🔍︎ proveedores" type="text" name="query">
     <button class="btn btn-outline-primary btn-sm" type="submit">BUSCAR</button>
     <a href="crear-producto" class="btn btn-outline-primary btn-sm" role="button">CREAR</a>

   </form>
 </div>
 <div class="row"> 
   <div class="clod-md-4"> </div>
   <div class="clod-md-6"> 
     <div class="row">   
       @if(@Auth::user()->hasRole('colaborador'))
       <table  class="table dataTable no-footer dtr-inline collapsed">
        <tr>
          <th>Rut Proveedor</th>
          <th>Digito verificador</th>
          <th>Razon social</th>
          <th>Giro</th>
          <th>Dirección</th>
          <th>Comuna</th>
          <th>Ciudad</th>
          <th>Banco</th>
          <th>Tipo cuenta</th>  
          <th>Numero cuenta</th>       
        </tr>
        @foreach($proveedores as $proveedor) 
        <tr>
          <td>{{$proveedor->rut_proveedor}} </td>
          <td>{{$proveedor->dig_rut_prov}}</td>
          <td>{{$proveedor->razon_social}}</td>
          <td>{{$proveedor->giro}}</td>
          <td>{{$proveedor->direccion_prov}}</td>
          <td>{{$proveedor->comuna_prov}}</td>
          <td>{{$proveedor->ciudad_prov}}</td>
          <td>{{$proveedor->banco}}</td>
          <td>{{$proveedor->tipo_cuenta}}</td>
          <td>{{$proveedor->n_cta_prov}}</td>
          <td><a class="btn btn-outline-primary btn-sm" href="modificar-proveedor/{{$proveedor->rut_proveedor}}"> Modificar 👻 </a></td>
        </tr>
        @endforeach
      </table>  
      @endif
    </div> 
  </div> 
</div> 
</div>      
</div>  


@endsection
