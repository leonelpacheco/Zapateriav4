@extends('admin.layoutAdmin')
@section('content')
	<div class="row fondoWhite">
		<div class="col-md-12 admin">
			<!--<?php echo csrf_token(); ?>-->
			<p><a href="{{ route('subcategorias.create') }}" class="btn btn-info">Nueva Subcategoria</a></p>
		</div>
	</div>
	<div class="row fondoWhite">
		<div class="col-md-12">
			<div class="table-responsive">
				
				<input id="_token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				{{Form::tablaResources($data['subcategorias'],'subcategorias','table table-hover table-bordered',$data['columnas'],'subcategorias')}}
			</div>
		</div>
	</div>
	
@stop
@section('js')
{{ HTML::script('assets/js/scriptJS/scriptGeneral.js') }}
@stop