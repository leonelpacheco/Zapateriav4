@extends('admin.layoutAdmin')
@section('content')
	<div class="row fondoWhite">
		<div class="col-md-12 admin  ultimo">
			<!--<?php echo csrf_token(); ?>-->
			<p><a href="{{ route('pedidos.create') }}" class="btn btn-info">Nuevo pedido</a></p>
			<div class="table-responsive">
				<input id="_token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				{{Form::tablaResources($data['pedidos'],'pedidos','table table-hover table-bordered',$data['columnas'],'pedidos')}}
			</div>
		</div>
	</div>
@stop

@section('js')
{{ HTML::script('assets/js/scriptJS/scriptGeneral.js') }}
@stop