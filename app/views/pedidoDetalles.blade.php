@extends('layout')
@section('content')
	<div class="row fondoWhite ultimo">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Informacion del pedido</h4>
				</div>
			</div>
			<div class="panel-collapse collapse in">
				<div class="panel-body">
					@if(sizeof($arrProductosNoStock))
					<p class="bg-danger">Los siguientes productos no estan disponibles inmediatamente, por favor pongase en contacto a los numeros siguientes para cualquier aclaración</p>
					<div class="table-responsive">
						<table class="table table-bordered fondoWhite">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Cantidad pedida</th>
									<th>Cantidad disponible</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($arrProductosNoStock as $producto) 
								<tr>
									<td>{{$producto['producto']}}</td>
									<td>{{$producto['cantidadPedida']}}</td>
									<td>{{$producto['stockDisponible']}}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					<div class="bg-danger">
						Es muy importante que nos contacte para aclarar el envio debido a que no todos los productos estan disponibles para envio inmediato.
					</div>
					@else
					<p class="bg-success">Su pedido fue procesado correctamente, una ves realizado el deposito por favor contactenos a los siguientes telefonos o al correo zapateriayovanna@gmail.com para que su pedido se enviado a la brevedad posible. Gracias por su preferncia.</p>
					@endif
				</div>
			</div>
		</div>
		
		
	</div>
@stop
@section('css')
	
@stop
@section('js')
	
@stop