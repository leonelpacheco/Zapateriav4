@extends('admin.layoutAdmin')
@section('content')
	<div class="row fondoWhite ultimo">
		<div class="col-md-12 admin">
			<!--<?php echo csrf_token(); ?>-->
			<p><a href="{{ route('proveedores.create') }}" class="btn btn-info">Nuevo proveedor</a></p>
			<div class="table-responsive">
				<input id="_token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				{{Form::tablaResources($data['proveedores'],'proveedores','table table-hover table-bordered',$data['columnas'],'proveedores')}}
			</div>
		</div>
	</div>


@stop

@section('js')
{{ HTML::script('assets/js/scriptJS/scriptGeneral.js') }}
@stop