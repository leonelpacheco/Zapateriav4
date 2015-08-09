@extends('admin.layoutAdmin')
@section('content')
	<div class="row fondoWhite">

		<div  class="col-md-12 admin">
			<!--<?php echo csrf_token(); ?>-->
			
			
			<p><a href="{{ route('categorias.create') }}" class="btn btn-info">Nueva Categoria</a></p>
			<div class="table-responsive">
				<input id="_token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				{{Form::tablaResources($data['categorias'],'categorias','table table-hover table-bordered',$data['columnas'],'categorias')}}
			</div>
		</div>
	</div>


@stop

@section('js')
{{ HTML::script('assets/js/scriptJS/scriptGeneral.js') }}
@stop