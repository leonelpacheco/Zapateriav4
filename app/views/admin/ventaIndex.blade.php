@extends('admin.layoutAdmin')
@section('content')

	<div class="row fondoWhite">
		<div class="col-md-12 admin">
			
			Ventas
		
    </div>	

<!-- {{ var_dump($productos) }} -->
 
 </div>


    <div class="row fondoWhite">
        <div class="col-md-12 ultimo">

  <table class="table table-striped table table-hover table-bordered">
    <tr>
        
        <th>Venta anual</th>
    </tr>
    @foreach ($productos as $producto)

    <tr>
        
        <td>{{ $producto->total }}</td>
    </tr>

    @endforeach
  </table>

        </div>
    </div>

	

    <div class="row fondoWhite">
        <div class="col-md-12 ultimo">

  <table class="table table-striped table table-hover table-bordered">
    <tr>
        
        <th>Venta del mes</th>
    </tr>
    @foreach ($productos2 as $producto2)

    <tr>
        
        <td>{{ $producto2->total }}</td>
    </tr>

    @endforeach
  </table>

        </div>
    </div>



@stop
@section('js')
{{ HTML::script('assets/js/scriptJS/scriptGeneral.js') }}
@stop