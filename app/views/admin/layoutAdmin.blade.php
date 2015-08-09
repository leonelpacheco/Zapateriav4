<!DOCTYPE HTML>
<html lang="en">
	<head>
		<link rel="icon" type="image/png" href="assets/img/favicon.ico" />
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	{{-- Bootstrap --}}
	    {{ HTML::style('assets/css/bootstrap/bootstrap.css', array('media' => 'screen')) }}
		{{ HTML::style('assets/css/fonts-icons/style.css', array('media' => 'screen')) }}

	    {{ HTML::style('assets/css/style.css', array('media' => 'screen')) }}
	    {{ HTML::style('assets/css/styles/index.css', array('media' => 'screen')) }}

	    {{-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --}}
	    <!--[if lt IE 9]>
	        {{ HTML::script('assets/js/html5shiv.js') }}
	        {{ HTML::script('assets/js/respond.min.js') }}
	    <![endif]-->
	    @yield("css","")
    	<title> @yield("title","Zapateria Yovanna")</title>
  	</head>
  	<body>
  		<input id="root" type="hidden" value="{{route('index')}}">
  		<input id="cartPush" type="hidden" value="{{route('cartPush')}}">
  		<input id="cartPop" type="hidden" value="{{route('cartPop')}}">
  		<input id="_token" type="hidden">
	  	{{-- Wrap all page content here --}}
	    <div id="wrap" style="height:100%">
		  		
   			<div class="container" style=" min-height:600px;">
	   			<div class="row">
	   				<div class=".col-md-12 ">
	   					<div id="header">
		   					<h1 id="logo">
		   						<a id="imgLogo" href="{{route('index')}}" ><img src="{{ asset('assets/images/logo.png') }}"  alt=""/></a>
		   					</h1>
		   					<p class="text-center header" style="font-weight: bold;position: absolute;margin-left: 100px;margin-top: 72px;">
		   						
		   					</p>

		   					
	   					</div>{{--fin header--}}

				    </div>
				</div>
				<div class="row fondoWhite" >
	   				<nav class="navbar navbar-default" role="navigation">
						
						<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
							    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								    <span class="sr-only">Toggle navigation</span>
								    <span class="icon-bar"></span>
								    <span class="icon-bar"></span>
								    <span class="icon-bar"></span>
							    </button>
							    <a class="navbar-brand" href="{{route('index')}}" style="@if(!empty($index)){{'background-color: #083E79'}}@endif">Inicio</a>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							    <ul class="nav navbar-nav" >
							    	<li>{{Form::mylink('Categorias','categorias',route('categorias.index'))}}</li>
									<li>{{Form::mylink('Subcategorias','subcategorias',route('subcategorias.index') )}}</li>
									<li>{{Form::mylink('Proveedores','Proveedores',route('proveedores.index') )}}</li>

									<li>{{Form::mylink('Productos','productos',route('productos.index') )}}</li>
									<li>{{Form::mylink('Usuarios','usuarios',route('usuarios.index') )}}</li>
									<li>{{Form::mylink('Pedidos','pedidos',route('pedidos.index') )}}</li>
									<li>{{Form::mylink('Pagos','pagos',route('pagos.index') )}}</li>
									<li>{{Form::mylink('Reportes','reportes',route('reportes.index') )}}</li>
									<li>{{Form::mylink('Ventas','ventas',route('ventas.index') )}}</li>
									<li><a class="navbar-brand" href="https://chipviscom.disqus.com/admin/moderate/#/approved " style="@if(!empty($index)){{'background-color: #083E79'}}@endif">Comentarios</a></li>
								</ul>
							       	
							</div><!-- /.navbar-collapse -->
						</div><!-- / container-fluid -->
					</nav>
				</div> 
	        	@yield('content')
	        	<div class="row fondoWhite" style=" min-height:600px;">
		        	<div class="col-md-12" id="footer">
						<div class="col-md-4 border">
							
						</div>
						<div class="col-md-4 quitar border">
							
						</div>
			        			
        			
						<div class="col-md-4 quitar border" style="border-style:none;">
							
							
        				</div>
					</div>
	      		</div>
	      	</div>
      	
      		
      	</div>
      	{{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}
      	 {{ HTML::script('assets/js/jquery.js') }}

	    <!--<script src="//code.jquery.com/jquery.js"></script>-->
	    {{-- Include all compiled plugins (below), or include individual files as needed --}}
	    {{ HTML::script('assets/js/bootstrap.min.js') }}
	    {{ HTML::script('assets/js/scriptJS/scriptIndex.js') }}
	    {{ HTML::script('assets/js/scriptJS/scriptCart.js') }}
	    @yield("js","")
	  	</body>
</html>