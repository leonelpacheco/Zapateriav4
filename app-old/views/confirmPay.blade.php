@extends('layout')

@section ('title')
Confirmar productos
@stop

@section('content')
	<div class="row fondoWhite ultimo" >
		<div class="col-md-10 col-md-offset-1 fondoCat" style="padding: 15px 15px 0 15px;">
			<div class="table-responsive">
				<table id="cartTable" class="table table-bordered fondoWhite">
					<thead>
						<tr>
							<th></th>
							<th>Producto</th>
							<th>Precio Unitario</th>
							<th style="width: 10%;" colspan="">Cantidad</th>
							<th colspan="2">Subtotal</th>
							
						</tr>
					</thead>
	    			<tbody id="confirmCarTbody">
	    			<?php $total = 0; ?>
	        		@if(!empty($cart))
        				@foreach ($cart as $producto  )
        					<tr >
        						<td> <div style="width: 70px;"><img src="{{$producto['img']}}" alt="{{$producto['producto']}}" class="img-responsive"> </div></td>
        						<td >{{$producto['producto']}}</td>
        						<td >${{$producto['precio']}}</td>
        						<td >
        							<input type="hidden" value="{{$producto['id']}}" name="idUpdate">
									<input type="text" class="form-control" name="cantUpdade" value="{{$producto['cantidad']}}"><i class="icon-spinner blockIcon" ></i>
								</td>
        						<td style="text-align: center;">${{$producto['precio']*$producto['cantidad']}}</td>
        						<td><i class="icon-close removeProducto" ><input type="hidden" value="{{$producto['id']}}" name="id"></i></td>
        					</tr>
        					<?php
        					$total += ($producto['precio']*$producto['cantidad']);
        					?>
        				@endforeach
	        		@else
	        			<tr>
	        				<td colspan="4" >Vacio	</td>
	        			</tr>
	        		@endif
	        		</tbody>
	    		</table>
			</div>
			<div class="row fondoWhite">
  				<div class="pull-right col-md-4 text-right fondoCat padding15px">
  					<h4 style="display: inline-block;">Total :</h4><h4 id="total" style="display: inline-block;">${{$total}}</h4><br>
  					<div class="col-md-12">
  					<a href="{{route('pay')}}" class="btn btn-primary">Pagar</a>
  					<a href="{{route('catalogo')}}" class="btn btn-primary">Seguir Comprando</a>
  					</div>
  				</div>
			</div>
		</div>
	</div>	
@stop
@section('css')
	{{ HTML::style('assets/css/styles/pay.css', array('media' => 'screen')) }}
@stop
@section('js')
	<script >
		$(function(){
			var total = $("#total").text().slice(1);
			
			$("#total").html("$"+formatMoney(total,2));
		})
	</script>
@stop