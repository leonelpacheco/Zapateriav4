@extends('layout')

@section ('title')
{{$producto->producto}}
@stop
@section('content')
<div class="row fondoWhite ultimo" >
	<div class="col-md-12">
		<div class="col-md-4">
				<img src="{{route('index')}}/assets/img/productos/{{$producto->img}}" class="img-responsive" alt="{{$producto->producto}}">
			
		</div>
		<div class="col-md-8 grisClaro" >
			
				<input type="hidden" id="idProducto" value="{{$producto->id}}">
				<input type="hidden" id="imgProducto" value="{{$producto->img}}">
				<h2 id="nameProducto">{{$producto->producto}}</h2>
				<h3>{{$producto->marca}}</h3>
				

			@if($producto->activo == 1)

				<h2 id="precioProducto">${{$producto->precio_inicial}}</h2>
				<!--<h3>Cantidad: {{$producto->cantidad}}</h3>-->

				<?php 
					$clase = ($producto->cantidad > 0) ? 'bg-success': 'bg-danger'; 
					$disponible = ($producto->cantidad > 0) ? ' Inmediata': ' Sobre pedido'; 
				?>
				<p class="{{$clase}}">Disponibilidad :{{$disponible}} </p>
				<form class="form-inline" role="form">
					
					<h3>Descripción:</h3>
				<p>{{$producto->descripcion}}</p>
				<label for="cantidadProducto" class="">Cantidad </label>
					<div class="form-group">
						
						<input id="cantidadProducto" type="text" name="cantidadProducto" value="1" class="form-control">

					</div>
						<button id="alCarrito" type="button" class="btn btn-primary">Al Carrito</button>
							<h3>Tienes dudas sobre este producto</h3>
				<a class="btn btn-primary" href="{{route('contacto')}}">Contáctanos</a> </br>
					
				</form>
			@elseif ($producto->activo==3) 
				
				
					<?php 
					$clase = ($producto->cantidad > 0) ? 'bg-success': 'bg-danger'; 
					$disponible = ($producto->cantidad > 0) ? ' Inmediata': ' Sobre pedido'; 
				?>
					<p class="{{$clase}}">Disponibilidad :{{$disponible}} </p>
				<form class="form-inline" role="form">
						<h3>Descripción:</h3>
					<p>{{$producto->descripcion}}</p>
					<h3>Te interesa éste producto</h3>
					<a class="btn btn-primary" href="{{route('contacto')}}">Contáctanos</a> </br>
				@endif

				</form>
		
		</div>
		</div>	
</div>	
@stop
@section('css')
	{{ HTML::style('assets/css/styles/pay.css', array('media' => 'screen')) }}
@stop
@section('js')
@stop