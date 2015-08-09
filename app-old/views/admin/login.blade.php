
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	{{-- Bootstrap --}}
	    {{ HTML::style('assets/css/bootstrap/bootstrap.min.css', array('media' => 'screen')) }}
		{{ HTML::style('assets/css/admin/login.css', array('media' => 'screen')) }}
	    {{-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --}}
	    <!--[if lt IE 9]>
	        {{ HTML::script('assets/js/html5shiv.js') }}
	        {{ HTML::script('assets/js/respond.min.js') }}
	    <![endif]-->
    	<title>Inicio de sesion</title>
  	</head>
  	<body>
  		<script>
	    	$(document).ready(function(){
	   			$('#log').validate();
	  		});
		</script>
	  	{{-- Wrap all page content here --}}
	    <div id="wrap">
   			<div class="container">

   				<div id="wrapLoginForm">
		        	<form id="log"class="form-horizontal" role="form" method="post" action="{{route('doLogin')}}">
		        	<h3 class="text-center">Introduzca sus datos</h3>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-8">
								<input type="text" class="form-control required" id="email" name="email" placeholder="Correo Electrónico">
								{{$errors->first('email')}}
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control required" id="password" name="password" placeholder="Contraseña">
								{{$errors->first('password')}}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label>
										<input type="checkbox"> Remember me
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Iniciar Sesión</button>
							</div>
						</div>
					</form>
				</div>
	      	</div>
      	</div>

	

      	{{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}
	    <script src="//code.jquery.com/jquery.js"></script>
	   	{{ HTML::script('assets/js/jquery.js') }}

	    {{-- Include all compiled plugins (below), or include individual files as needed --}}

	    {{ HTML::script('assets/js/bootstrap.min.js') }}
	    {{ HTML::script('assets/js/validate.js') }}
	</body>

</html>


