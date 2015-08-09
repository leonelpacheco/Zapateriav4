@extends('layoutdetalle')

@section ('title')
Confirmar productos
@stop
@section ('titulo')
Confirmar productos
@stop
@section('content')


<div class="main_bg">
<div class="wrap">
<div class="main">
	<!-- start content -->
	<div class="single">
			<!-- start span1_of_1 -->
			<div class="left_content">
			
			<!-- start span1_of_1 -->
		
				  <div class="desc1 btn_form">
                  <div class="row fondoWhite ultimo" >
                   <div class="  panel panel-default">
  <div class="panel-heading"></div>
  <div class="panel-body">
  
		<div class="col-md-10 col-md-offset-1 fondoCat" style="padding: 15px 15px 0 15px;">
			<div class="table-responsive bg-success">
				<table id="cartTable"  class="table table-bordered">
					<thead>
						<tr class="active">
							<th></th>
							<th>Producto</th>
							<th>Precio Unitario</th>
							<th style="width: 10%;" colspan="">Cantidad</th>
							<th colspan="2">Subtotal</th>
							
						</tr>
					</thead>
	    			<tbody id="confirmCarTbody">
	    			<?php $total = 0; ?>
	        		@if(!empty($cart))
        				@foreach ($cart as $producto  )
        					<tr >
        						<td class="active"> <div style="width: 70px;"><img  src="{{$producto['img']}}" alt="{{$producto['producto']}}" class="img-responsive img-thumbnail"> </div></td>
        						<td >{{$producto['producto']}}</td>
        						<td >${{$producto['precio']}}</td>
        						<td >
        							<input type="hidden" value="{{$producto['id']}}" name="idUpdate">
									<input type="text" class="form-control" name="cantUpdade" value="{{$producto['cantidad']}}"><i class="icon-spinner blockIcon" ></i>
								</td>
        						<td style="text-align: center;">${{$producto['precio']*$producto['cantidad']}}</td>
        						<td><i class="icon-close removeProducto" ><input type="hidden" value="{{$producto['id']}}" name="id"></i></td>
        					</tr>
        					<?php
        					$total += ($producto['precio']*$producto['cantidad']);
        					?>
        				@endforeach
	        		@else
	        			<tr>
	        				<td colspan="4" >Vacio	</td>
	        			</tr>
	        		@endif
	        		</tbody>
	    		</table>
			</div>
			<div class="row active">
  				<div class="pull-right col-md-4 text-right fondoCat padding15px">
  					<h4 style="display: inline-block;">Total :</h4><h4 id="total" style="display: inline-block;">${{$total}}</h4><br>
  					<div class="col-md-12">
  					<a href="{{route('pay')}}" class="btn btn-primary">Pagar</a>
  					</div>
                    <div class="col-md-12">
                    <a href="{{route('catalogo')}}" class="btn btn-primary">Seguir Comprando</a>
  					</div>
  				</div>
			</div>
		</div>
	</div>
    </div>
    </div>
				</div>
			   
			   	<div class="clear"></div>
			   	<!-- start left content_bottom -->
			   	
			   	<!-- end left content_bottom -->
		   	</div>
		<!-- start left_sidebar -->
			<div class="left_sidebar">
				
				<img src="{{ asset('assets/images/shutterstock_20170813.jpg') }}" alt=""/>
			</div>
          	    <div class="clear"></div>
	       </div>	
	<!-- end content -->
	</div>
</div>
</div>


		
@stop
@section('css')
	{{ HTML::style('assets/css/styles/pay.css', array('media' => 'screen')) }}
@stop
@section('js')
	<script >
		$(function(){
			var total = $("#total").text().slice(1);
			
			$("#total").html("$"+formatMoney(total,2));
		})
	</script>
@stop