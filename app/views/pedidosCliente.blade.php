@extends('layout')
@section('content')
	<div class="row fondoWhite ultimo">
		<div class="col-md-12">
			<?php #echo csrf_token(); ?>			
			<div class="table-responsive">
				<input id="_token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				{{Form::tablaPedidos($data['pedidos'],'pedidos','table table-hover table-bordered',$data['columnas'],'pedidos')}}
			</div>
		</div>
	</div>
@stop

@section('js')
{{ HTML::script('assets/js/scriptJS/scriptGeneral.js') }}
@stop