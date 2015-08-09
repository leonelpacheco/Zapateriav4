@extends('layout')

@section ('title')
{{$producto->producto}}
@stop
@section ('titulo')
{{$producto->producto}}
@stop

@section('content')


<div class="main_bg">
<div class="wrap">
<div class="main">
	<!-- start content -->
	<div class="single">
			<!-- start span1_of_1 -->
            <div class=" left_content  panel panel-default">
  <div class="panel-heading"></div>
  <div class="panel-body">
  
			<div class=" " role="alert">
			<div class="span1_of_1">
				<!-- start product_slider -->
				<div class="product-view">
				    <div class="product-essential">
				        <div class="product-img-box">
				    
				    <div class="product-image"> 
				        <a class="cs-fancybox-thumbs cloud-zoom" rel="adjustX:30,adjustY:0,position:'right',tint:'#202020',tintOpacity:0.5,smoothMove:2,showTitle:true,titleOpacity:0.5" data-fancybox-group="thumb" href="{{route('index')}}/assets/img/productos/{{$producto->img}}" title="Women Shorts" alt="{{$producto->producto}}">
				           	<img src="{{route('index')}}/assets/img/productos/{{$producto->img}}" alt="{{$producto->producto}}" title="Women Shorts" />
				        </a>
				   </div>
					
				</div>
				</div>
				</div>
			<!-- end product_slider -->
			</div>
            
            
			<!-- start span1_of_1 -->
			<div class="span1_of_1_des">
				  <div class="desc1 btn_form">
				<input type="hidden" id="idProducto" value="{{$producto->id}}">
				<input type="hidden" id="imgProducto" value="{{$producto->img}}">
				<h2 id="nameProducto">{{$producto->producto}}</h2>
				<h3>{{$producto->marca}}</h3>
				

			@if($producto->activo == 1)

				<h2 id="precioProducto">${{$producto->precio_inicial}}</h2>
				<!--<h3>Cantidad: {{$producto->cantidad}}</h3>-->

				<?php 
					$clase = ($producto->cantidad > 0) ? 'bg-success': 'bg-danger'; 
					$disponible = ($producto->cantidad > 0) ? ' Inmediata': ' Sobre pedido'; 
				?>
				<p class="{{$clase}}">Disponibilidad :{{$disponible}} </p>
				<form class="form-inline" role="form">
					
					<h3>Descripción:</h3>
				<p>{{$producto->descripcion}}</p>
				<label for="cantidadProducto" class="">Cantidad </label>
					<div class="form-group">
						
						<input id="cantidadProducto" type="text" name="cantidadProducto" value="1" class="form-control">

					</div>
						
                        <input id="alCarrito" type="button" value="Al Carrito">
							<h3>Tienes dudas sobre este producto</h3>
				<a class="btn btn-primary" href="{{route('contacto')}}">Contáctanos</a> </br>
					
				</form>
			@elseif ($producto->activo==3) 
				
				
					<?php 
					$clase = ($producto->cantidad > 0) ? 'bg-success': 'bg-danger'; 
					$disponible = ($producto->cantidad > 0) ? ' Inmediata': ' Sobre pedido'; 
				?>
					<p class="{{$clase}}">Disponibilidad :{{$disponible}} </p>
				<form class="form-inline" role="form">
						<h3>Descripción:</h3>
					<p>{{$producto->descripcion}}</p>
					<h3>Te interesa éste producto</h3>
					<a class="btn btn-primary " href="{{route('contacto')}}">Contáctanos</a> </br>
                    
				@endif
 </form></div>
			   	</div>
			   	<div class="clear"></div>
			   	<!-- start left content_bottom -->
			   	<!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
<a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=http%3A%2F%2Fwww.chipvis.com&pubid=ra-55c630c418b0ac4b&ct=1&title=zapateria%20yobana&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
<a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=http%3A%2F%2Fwww.chipvis.com&pubid=ra-55c630c418b0ac4b&ct=1&title=zapateria%20yobana&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
<a href="https://www.addthis.com/bookmark.php?source=tbx32nj-1.0&v=300&url=http%3A%2F%2Fwww.chipvis.com&pubid=ra-55c630c418b0ac4b&ct=1&title=zapateria%20yobana&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/addthis.png" border="0" alt="Addthis"/></a>
			   	<!-- end left content_bottom -->
		   	</div>

<br>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like"></div>


            </div>

</div>


		<!-- start left_sidebar --> 
			<div class="left_sidebar " role="alert">
				<img src="{{ asset('assets/images/shutterstock_20170813.jpg') }}" alt=""/>
				
			</div>
          	    <div class="clear"></div>
	       </div>	
	<!-- end content -->
	</div>

	<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'chipviscom';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

</div>
</div>

@stop
@section('css')
@stop
@section('js')
@stop