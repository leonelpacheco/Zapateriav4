@extends('admin.layoutAdmin')
@section('content')
@section ('title') {{ $action }} pedido @stop
@section ('content')
	<div class="row fondoWhite">
		<div class="col-md-12">
			<h2>{{ $action }} pedido</h2>

			<p>
				<a href="{{ route('pedidos.index') }}" class="btn btn-info">Ir a pedidos</a>
			</p>
		</div>
	</div>
	<div class="row fondoWhite">
		<div class="col-md-12 ultimo">
		{{ Form::model($pedido, $form_data, array('role' => 'form')) }}
			<div class="row">
				<div class="form-group col-md-3">
					{{ Form::label('cliente', 'Cliente') }}
					{{--Form::text('cliente', null, array('placeholder' => 'Cliente', 'class' => 'form-control'))--}}
					{{ Form::myselect($clientes,'','cliente','email',$col='id')}}
				</div>
			</div>
			{{ Form::myselect($productos,'','productosHidden','producto','id','hide')}}
			<div class="table-responsive">
				<table class="table table-hover table-bordered" >
					<thead>
						<tr>
							<th>id</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody id="pedido_productos">
					
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					{{ Form::button('agregar producto', array('id'=>'agregar','type' => 'button', 'class' => 'btn btn-primary')) }} 
				</div>
			</div>
			{{ Form::button($action . ' pedido', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    

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