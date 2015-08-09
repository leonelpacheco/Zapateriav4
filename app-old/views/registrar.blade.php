@extends ('layoutpage')


@section ('title')
{{$titulo}}
@stop

@section ('titulo')
Ingresa o crea una cuenta
@stop
@section ('content')
<?php  
	$nombre        = ($cliente) ? $cliente['nombres'] : '';
	$apellidos     = ($cliente) ? $cliente['apellidos'] : '';
	$email         = ($cliente) ? $cliente['email'] : '';
	$telefono      = ($cliente) ? $cliente['telefono'] : '';
	$password      = ($cliente) ? $cliente['password'] : '';
	$empresa       = ($cliente) ? $cliente['empresa'] : '';
	$rfc           = ($cliente) ? $cliente['rfc'] : '';
	$calleNum      = ($cliente) ? $cliente['calleNum'] : '';
	$colonia       = ($cliente) ? $cliente['colonia'] : '';
	$codigopostal  = ($cliente) ? $cliente['codigopostal'] : '';
	$ciudad        = ($cliente) ? $cliente['ciudad'] : '';
	$estado        = ($cliente) ? $cliente['estado'] : '';
	$pais          = ($cliente) ? $cliente['pais'] : '';
	?>
<div class="main_bg">
<div class="wrap">
<div class="main">
	<div class="login_left">
		<h3>login</h3>
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
		<a href="#"><div class="reg_fb"><img src="images/facebook.png" alt=""><i>Introduzca sus datos</i><div class="clear"></div></div></a>
		 <div class="registration_form">
		 <!-- Form -->
			<form id="log" class="form-horizontal" role="form" method="post" action="{{route('doLoginCliente')}}">
				<div>
					<label>
						<input type="text" class="form-control required" id="email" name="email" placeholder="Correo Electrónico">
						{{$errors->first('email')}}
					</label>
				</div>
				<div>
					<label>
						<input type="password" class="form-control required" id="password" name="password" placeholder="Contraseña">
						{{$errors->first('password')}}
					</label>
				</div>						
				<div>
            
						
					<input type="submit"  id="login"  class="btn btn-primary" value="Iniciar Sesión">
				</div>
				<div class="forget">
				<a id="login" type="" class="" href="{{route('recuperarContrasena')}}">Olvide mi contraseña</a>
				</div>
                <div class="forget">
					<a id="register" href="{{route('registrarCliente')}}">Registrarme</a>
				</div>
			</form>
			<!-- /Form -->
		</div>
	</div>
	</div>
	<!-- end registration -->
	</div>
	<div class="login_left">
		<h3>Registrarme </h3>
		<!--<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping address, view and track your orders in your accoung and more.</p>-->
		<div class="registration_left">
		<a href="#"><div class="reg_fb"><img src="images/facebook.png" alt=""><i>Datos personales</i><div class="clear"></div></div></a>
		 <div class="registration_form">
		 <!-- Form -->
         {{ Form::model($cliente, $form_data, array('role' => 'form')) }}
         <div class="panel-heading">
			<div class="panel-title">
				<h2 >{{$titulo}} </h2>
			</div>
		</div>
		@if (Session::has('div'))
		{{Session::get('div')}} 
		@endif
				<div>
					<label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{$nombre}}">
					</label>
				</div>
				<div>
					<label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="{{$apellidos}}">
					</label>
				</div>
                
                <div>
					<label>
													<input id="emailHide" name="emailHide" value="{{$email}}" type="hidden" >
						
							<input type="text" class="form-control" name="email" id="email" placeholder="ejempl@email.com" value="{{$email}}">

					</label>
				</div>
                
                <div>
					<label>
							<input type="text" class="form-control" name="telefono" id="telefono" placeholder="No. Telefonico" value="{{$telefono}}">
					</label>
				</div>
                
                <div>
					<label>
						<input type="password" class="form-control" name="password_registro" id="password_registro" placeholder="*****" value="{{$password}}">
					</label>
				</div>
                
                <div>
					<label>
						<input type="password" class="form-control" name="password_registroConfirm" id="password_registroConfirm" placeholder="*****" value="{{$password}}">
					</label>
				</div>
                
                
				
						<a href="#"><div class="reg_fb"><i>Datos de la empresa</i></div></a>
				
				
                
					<div >
						<label for="empresa">Empresa</label>
						<input type="text" class="form-control" name="empresa" id="empresa" placeholder="Empresa" value="{{$empresa}}">
					</div>
				

			
					<div >
						<label for="rfc">RFC</label>
						<input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" value="{{$rfc}}">
					</div>
				

				<h4>Direccion</h4>
					
					<div >
						<label for="calle">Calle y numero*</label>
						<input type="text" class="form-control" name="calle" id="calle" placeholder="Calle y No." value="{{$calleNum}}">
					</div>
					
					<div >
						<label for="ciudad">Ciudad*</label>
						<input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" value="{{$ciudad}}">
					</div>
					
					<div >
						<label for="pais">Pais*</label>
						<input type="text" class="form-control" name="pais" id="pais" placeholder="Pais" value="{{$pais}}">
					</div>

					<div >
						<label for="colonia">Colonia*</label>
						<input type="text" class="form-control" name="colonia" id="colonia" placeholder="Colonia" value="{{$colonia}}">
					</div>
					<div >
						<label for="codigoPostal">Codigo Postal*</label>
						<input type="text" class="form-control" name="codigoPostal" id="codigoPostal" placeholder="Codigo Postal" value="{{$codigopostal}}">
					</div>
					<div >
						<label for="estado">Provincia/Estado*</label>
						<input type="text" class="form-control" name="estado" id="estado" placeholder="Provincia/Estado" value="{{$estado}}">
					</div>
                
                
                	
				<div>
               
					<input id="openPaso3" type="submit" class="btn btn-default rigth" data-toggle="" data-target="#" data-parent="#accordion" value="{{$boton}}" >
				</div>
				<div class="sky_form">
               
				
					<label class="checkbox"><input id="terminosCondiciones" type="checkbox" name="terminosCondiciones" value="1"><i>i agree to <a class="terms" href="#"> Acepto los terminos y condiciones.</a> </i></label>
				</div>
            {{ Form::close() }}
			<!-- /Form -->
		</div>
	</div>
	</div>
	<div class="clear"></div>
</div>
</div>
</div>



@stop
@section('js')
	{{HTML::script('assets/js/scriptJS/scriptLoginCliente.js')}}
@stop