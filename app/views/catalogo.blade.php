@extends('layoutpage')

@section ('titulo')
    Nuestros Productos

@stop
@section('content')




<div class="main_bg">
<div class="wrap">
<div class="main" >
	<div class="row " >
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
							    		
							    			{{form::input('button', null, 'buscar', array('class'=>'btn btn-primary','id'=>'buscar'))}}
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
	
	<!-- start grids_of_3 -->
	
	<div class="clear"></div>
    
	<!-- start grids_of_2 -->
	
</div>
</div>
</div>

	
@stop
@section('css')
	{{ HTML::style('assets/css/styles/catalogo.css', array('media' => 'screen')) }}
@stop
@section('js')
	{{HTML::script('assets/js/scriptJS/scriptCatalogo.js')}}
    
    <script type="text/javascript">
//productos obtenidos
var arrProductos;
/*productos que se mostraban antes del change*/
var beforeShow = 10;
/*esta variable sirve para saber el numero de pagina actual */
var puntero = 0;

$("#buscando").click(function(){

var buscar = $('#buscar').val();
var objAjax = ajax('catalogo/buscar',buscar,'get','json',0);
		objAjax
	.done(function(data){
		/*data tiene dos objetos: productos y subcategorias*/
		arrProductos = data.productos;
	});


});
    </script>
@stop