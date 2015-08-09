@extends('admin.layoutAdmin')
@section('content')
@section ('title') Pedido @stop
@section ('content')
	<div class="row fondoWhite">
		<div class="col-md-12">
			<h2>Pedido</h2>

			<p>
				<a href="{{ route('pedidos.index') }}" class="btn btn-info">Ir a pedidos</a>
			</p>
		</div>
	</div>
	<div class="row fondoWhite ultimo">
		<div class="col-md-12">
			{{ Form::model($arrPedidos, $form_data, array('role' => 'form')) }}
				<div class="row">
					<div class="form-group col-md-3">
						{{ Form::label('cliente', 'Cliente') }}
						{{ Form::label('cliente', $arrPedidos[0]['email']) }}
					</div>
				</div>
				<?php $estado = (($arrPedidos[0]['estado'] == 0)) ? 1 : 0;?>
				<input type="hidden" value="{{$estado}}" name="estado">
				<div class="table-responsive">
					<table class="table table-hover table-bordered" >
						<thead>
							<tr>
								<th>id</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio Unitario</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody id="pedido_productos">
						<?php $total=0;?>
						@for ($i=0; $i < sizeof($arrPedidos); $i++) 
							<tr>
								<td>{{$arrPedidos[$i]['idProducto']}}</td>
								<td>{{$arrPedidos[$i]['producto']}}</td>
								<td>{{$arrPedidos[$i]['num_productos']}}</td>
								<td>${{$arrPedidos[$i]['precio']}}</td>
								<?php $subtotal = $arrPedidos[$i]['num_productos'] * $arrPedidos[$i]['precio'];
								$total += $subtotal;
								?>
								<td>${{$subtotal}}</td>
							</tr>
						@endfor
							<tr>
								<td colspan="5"></td>
							</tr>
							<tr style="font-weight:bold">
								<td colspan="3"></td>
								<td>Total</td>
								<td>${{$total}}</td>
							</tr>
						</tbody>
					</table>
				</div>
				@if($arrPedidos[0]['estado'] == 0)
					{{ Form::button('Enviar pedido', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
				@endif
			{{ Form::close() }}
		</div>
	</div>

@stop
@section('css')
{{ HTML::style('assets/css/admin/pedido.css', array('media' => 'screen')) }}
@stop
@section('js')
{{ HTML::script('assets/js/scriptJS/scriptPedido.js') }}
@stop