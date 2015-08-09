@extends('layoutpage')
@section('content')
@section ('titulo')
    Nuestros Productos

@stop
<div class="main_bg">
<div class="wrap">
<div class="main">
	<div class="top_main">
		<h2>Lo más reciente</h2>
		<a href="#">Mostrar todo</a>
		<div class="clear"></div>
	</div>
	<!-- start grids_of_3 -->
	<div class="grids_of_3">
		<div class="grid1_of_3">
			<a href="details.html">
				<img src="{{ asset('assets/images/pic1.jpg') }}" alt="">
				<h3>even &amp; odd</h3>
				<span class="price">$145,99</span>
			</a>
		</div>
		<div class="grid1_of_3">
			<a href="details.html">
				<img src="{{ asset('assets/images/pic2.jpg') }}" alt="">
				<h3>buffalo decollete</h3>
				<span class="price">$185,99</span>
				<span class="price1 bg">En venta</span>
			</a>
		</div>
		<div class="grid1_of_3">
			<a href="details.html">
				<img src="{{ asset('assets/images/pic3.jpg') }}" alt="">
				<h3>even &amp; odd</h3>
				<span class="price">$145,99</span>
			</a>
		</div>
		<div class="clear"></div>
	</div>
	<div class="top_main">
		<h2>Más vendidos del mes</h2>
		<a href="#">Mostrar todo</a>
		<div class="clear"></div>
	</div>
	<!-- start grids_of_3 -->
	<div class="grids_of_3">
		<div class="grid1_of_3">
			<a href="details.html">
				<img src="{{ asset('assets/images/pic4.jpg') }}" alt="">
				<h3>buffalo decollete</h3>
				<span class="price">$145,99</span>
			</a>
		</div>
		<div class="grid1_of_3">
			<a href="details.html">
				<img src="{{ asset('assets/images/pic5.jpg') }}" alt="">
				<h3>even &amp; odd</h3>
				<span class="price">$185,99</span>
			</a>
		</div>
		<div class="grid1_of_3">
			<a href="details.html">
				<img src="{{ asset('assets/images/pic6.jpg') }}" alt="">
				<h3>buffalo decollete</h3>
				<span class="price">$145,99</span>
				<span class="price1 bg1">out of stock</span>
			</a>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<!-- start grids_of_2 -->
	<div class="grids_of_2">
		<div class="grid1_of_2">
			<div class="span1_of_2">
				<h2>Envío gratis</h2>
				<!--<p>Lorem Ipsum is simply dummy  typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
			--></div>
			<div class="span1_of_2">
				<h2>testimonials</h2>
				<p><!--It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using [...-->]</p>
			</div>
		</div>
		<div class="grid1_of_2 bg">
			<h2>blog news</h2>
			<div class="grid_date">
				<div class="date1"> 
					<h4>apr 01</h4>
				</div>
				<div class="date_text">
					<!--<h4><a href="#"> Donec vehicula est ac augue consectetur,</a></h4>
					<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p> -->
				</div>
				<div class="clear"></div>
			</div>
			<div class="grid_date">
				<div class="date1"> 
					<h4>feb 01</h4>
				</div>
				<div class="date_text">
					<!--<h4><a href="#"> The standard chunk of Lorem Ipsum used since ,,</a></h4>
					<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from </p>--> 
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
</div>


	<div class="row fondoWhite ultimo" >
		<div class="col-md-3">
			<ul class="list-group" id="categorias">
			@for ($i=0; $i < sizeof($categorias); $i++) 
				<li id="{{$categorias[$i]['id']}}" class="list-group-item">
					{{$categorias[$i]['categoria']}}<input value="{{$categorias[$i]['id']}}" type="checkbox" name="categorias[]" style="float:right;">
				</li>
			@endfor
			</ul>
		</div>
		<div class="col-md-9 fondoCat" >
			<div class="row" style="margin-bottom:10px;">
				<div class="col-md-9 texto" style="margin-top:10px;" >
					{{ Form::label('mostrar', 'Articulos por pagina') }}
					{{ Form::select( 'mostrar', array('10'=>'10','15'=>'15','20'=>'20') 	) }}
					{{ Form::label('subcategoria', 'Subcategoria') }}
				
					<select name="subcategoria" id="subcategoria"></select>
					
					
				</div>
				 <form class="navbar-form navbar-right busqueda" >

										<div class="form-group">
										{{form::open(array
											(
											'action'=>'CatalogoController@buscar',
											'method'=>'GET',
											'role'=>'form',
											'class'=>'form-inline'

											))}}
							    			{{Form::input('text','buscar', Input::get('buscar'), array('class'=>'form-control', 'placeholder'=>'buscar'))}}
							    		</div>
							    		
							    			{{form::input('submit', null, 'buscar', array('class'=>'btn btn-primary'))}}
							    			{{form::close()}}

							    		
					</form>	
				
			</div>
@if(!isset($_GET['buscar']))

<div id="results" class="row">
			
</div>
	

@else

	<div class="row">
		
		
	</div>
	



			
@endif	


			<div class="col md-4">
				<ul id="paginacion" class="pagination">
	  				<li id="before" class="disabled"><span>&laquo;</span></li>
	  				<li id="next"><a href="#">&raquo;</a></li>
	  			</ul>
			</div>
		</div>
	</div>	
@stop
@section('css')
	{{ HTML::style('assets/css/styles/catalogo.css', array('media' => 'screen')) }}
@stop
@section('js')
	{{HTML::script('assets/js/scriptJS/scriptCatalogo.js')}}
@stop