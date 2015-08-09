@extends('admin.layoutAdmin')
@section('content')

	<div class="row fondoWhite">
		<div class="col-md-12 admin">
			
			Productos más vendidos
		
    </div>	

<!-- {{ var_dump($productos) }} -->
 
 </div>


    <div class="row fondoWhite">
        <div class="col-md-12 ultimo">

  <table class="table table-striped table table-hover table-bordered">
    <tr>
        <th>Producto</th>
        <th>Cantidad vendida</th>
    </tr>
    @foreach ($productos as $producto)

    <tr>
        <td>{{ $producto->descripcion }}</td>
        <td>{{ $producto->total }}</td>
    </tr>

    @endforeach
  </table>

        </div>
    </div>


    <div class="row fondoWhite">
        <div class="col-md-12 admin">
            
            Top de clientes
        
    </div>  
      </div>  
    <div class="row fondoWhite">
        <div class="col-md-12 ultimo">

  <table class="table table-striped table table-hover table-bordered">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellidos</th>
    </tr>
    @foreach ($clientes as $cliente)

    <tr>
        <td>{{ $cliente->id }}</td>
        <td>{{ $cliente->nombres }}</td>
        <td>{{ $cliente->apellidos }}</td>
    </tr>

    @endforeach
  </table>

        </div>
    </div>
	


@stop
@section('js')
{{ HTML::script('assets/js/scriptJS/scriptGeneral.js') }}
@stop