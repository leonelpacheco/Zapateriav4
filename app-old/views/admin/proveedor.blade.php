@extends('admin.layoutAdmin')
@section('content')
@section ('title') {{ $action }} Proveedor @stop
@section ('content')
	<div class="row fondoWhite ultimo">
		<div class="col-md-12">
			<h2>{{ $action }} Proveedor</h2>

			<p><a href="{{ route('proveedores.index') }}" class="btn btn-info">Proveedores</a></p>

			{{ Form::model($proveedor, $form_data, array('role' => 'form')) }}
				<div class="row">
					<div class="form-group col-md-3">
						{{ Form::label('proveedor', 'proveedor') }}
						{{ Form::text('proveedor', null, array('placeholder' => 'Proveedor', 'class' => 'form-control')) }}
					</div>
					<div class="form-group col-md-3">
						{{ Form::label('descripcion', 'Descripcion') }}
						{{ Form::text('descripcion', null, array('placeholder' => 'Descripcion', 'class' => 'form-control')) }}     
					</div>
					<div class="form-group col-md-3">
						{{ Form::label('correo', 'correo') }}
						{{ Form::text('correo', null, array('placeholder' => 'Correo', 'class' => 'form-control')) }}     
					</div>
					<div class="form-group col-md-3">
						{{ Form::label('telefono', 'Telefono') }}
						{{ Form::text('telefono', null, array('placeholder' => 'Telefono', 'class' => 'form-control')) }}     
					</div>
					<div class="form-group col-md-3">
						{{ Form::label('rfc', 'rfc') }}
						{{ Form::text('rfc', null, array('placeholder' => 'RFC', 'class' => 'form-control')) }}     
					</div>
					
				</div>
				{{ Form::button($action . 'Proveedor', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    

			{{ Form::close() }}
			@include ('errores', array('errores' => $errors ))
		</div>
	</div>

@stop
