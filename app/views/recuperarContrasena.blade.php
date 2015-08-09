@extends('layout')
@section ('title')
Recuperar contraseña 
@stop 
@section ('titulo')
Recuperar contraseña 
@stop
@section('content')

<div class="main_bg">
<div class="wrap">
<div class="main">
	<div class="login_left">
		<h3>Recuperar contraseña</h3>
<!--		<p>if you have any account with us, please log in.</p>
-->	<!-- start registration -->
	<div class="registration">
		<!-- [if IE] 
		    < link rel='stylesheet' type='text/css' href='ie.css'/>  
		 [endif] -->  
		  
		<!-- [if lt IE 7]>  
		    < link rel='stylesheet' type='text/css' href='ie6.css'/>  
		<! [endif] -->  
		<script>
			(function() {
		
			// Create input element for testing
			var inputs = document.createElement('input');
			
			// Create the supports object
			var supports = {};
			
			supports.autofocus   = 'autofocus' in inputs;
			supports.required    = 'required' in inputs;
			supports.placeholder = 'placeholder' in inputs;
		
			// Fallback for autofocus attribute
			if(!supports.autofocus) {
				
			}
			
			// Fallback for required attribute
			if(!supports.required) {
				
			}
		
			// Fallback for placeholder attribute
			if(!supports.placeholder) {
				
			}
			
			// Change text inside send button on submit
			var send = document.getElementById('register-submit');
			if(send) {
				send.onclick = function () {
					this.innerHTML = '...Sending';
				}
			}
		
		})();
		</script>
	<div class="registration_left">
		<a href="#"><div class="reg_fb"><img src="images/facebook.png" alt=""><i></i><div class="clear"></div></div></a>
		 <div class="registration_form">
		 <!-- Form -->
			<form id="log" class="form-horizontal" role="form" method="post" action="{{route('doLoginCliente')}}">
				<div>
					<label>
						<input type="text" class="form-control required" id="email" name="email" placeholder="Correo Electrónico">
					</label>
				</div>
										
				<div>
            
						
					<input type="submit"  id="login"  class="btn btn-primary" value="Enviar Contraseña">
				</div>
				<div class="forget">
				<a id="login" type="" class="" href="{{route('recuperarContrasena')}}">Olvide mi contraseña</a>
				</div>
                <div class="forget">
					<a id="register" href="{{route('registrarCliente')}}" >Registrarme</a>
				</div>
			</form>
			<!-- /Form -->
		</div>
	</div>
	</div>
	<!-- end registration -->
	</div>
	
	<div class="clear"></div>
</div>
</div>
</div>
	
		
	
@stop
@section('css')
@stop
@section('js')
	{{HTML::script('assets/js/scriptJS/scriptLoginCliente.js')}}
@stop