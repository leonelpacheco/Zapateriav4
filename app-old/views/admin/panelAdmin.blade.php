@extends('admin.layoutAdmin')
@section('content')

			<!--<?php echo csrf_token(); ?>-->
			{{--Form::mylistUl($data,'secciones','classe')--}}
			<!--@for ($i=0; $i < sizeof($data); $i++) 
				{{Form::mylink($data[$i],$data[$i],route($data[$i].'.index') )}}
			@endfor-->
		
	<div class="row fondoWhite">
		<div class="col-md-12 admin  ultimo">
			<div class="table-responsive">
				{{Form::tablaResources($pedidos,'pedidos','table table-hover table-bordered',$col,'pedidos')}}
			</div>
			<input id="add" type="button" value="Agregar">
			<input id="quit" type="button" value="Quitar">
			<input id="show" type="button" value="Mostrar">
		</div>
	</div>
	
@stop

@stop
@section('js')
	{{ HTML::script('assets/js/scriptJS/scriptCart.js') }}
@stop