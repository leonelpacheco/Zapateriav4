@extends ('layout')

@section ('title')
Contacto 
@stop 

@section ('content')


<div class="row fondoWhite">
	<div class="col-md-12">
		
		<ul>
			
		@foreach ($productos as $producto)
   			 <p>This is user {{ $producto->descripcion }}</p>
		@endforeach

		
		</ul>
				
	</div>			
</div>




@stop
@section('js')
	{{ HTML::style('assets/css/styles/pay.css', array('media' => 'screen')) }}
	<script src='https://www.google.com/recaptcha/api.js'></script>
@stop