@extends ('layout')

@section ('title')
Contacto 
@stop 
 @section ('titulo')
Contáctenos
@stop
@section ('content')
<!-- start main -->
<div class="main_bg">
<div class="wrap">
<div class="main">
	<div class="contact">				
				<div class="contact_left">
					<div class="contact_info">
			    	 	<h3>Encuentranos Aquí</h3>
			    	 		<div class="map">
                            
					   			<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14924.863778743516!2d-89.47516664999998!3d20.742039750000014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f566733774d03a1%3A0x70d9138e8404cc8f!2sTecoh%2C+Yuc.!5e0!3m2!1ses-419!2smx!4v1435294424063"></iframe><br><small><a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14924.863778743516!2d-89.47516664999998!3d20.742039750000014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f566733774d03a1%3A0x70d9138e8404cc8f!2sTecoh%2C+Yuc.!5e0!3m2!1ses-419!2smx!4v1435294424063" style="color:#242424;text-shadow:0 1px 0 #ffffff; text-align:left;font-size:12px;padding: 5px;">View Larger Map</a></small>
					   		</div>
      				</div>
      			<div class="company_address">
				     	<h3>Información De La Empresa:</h3>
						    	<p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <a href="mailto:info@mycompany.com">info(at)mycompany.com</a></p>
				   		<p>Follow on: <a href="#">Facebook</a>, <a href="#">Twitter</a></p>
				   </div>
				</div>				
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Contáctenos</h3>
                    {{form::open(array('role'=>'form','action' => 'IndexController@postContact' ))}}
					  <!--  <form method="post" action="contact-post.html">-->
					    	<div>
						    	<span>{{ Form::label('nombre', 'NOMBRE') }}</span>
						    	<span>{{ Form::text('nombre', null, array('placeholder' => 'Nombre', 'class' => 'form-control','required'=>'1')) }}</span>
						    </div>
						    <div>
						    	<span>{{ Form::label('email', 'E-MAIL') }}</span>
						    	<span>
                                {{ Form::text('email', null, array('placeholder' => 'Correo', 'class' => 'form-control','required'=>'1')) }}
                                </span>
						    </div>
						    <div>
						     	<span>{{ Form::label('telefono', 'TELEFONO') }}></span>
						    	<span>
                                {{ Form::text('telefono', null, array('placeholder' => 'Teléfono', 'class' => 'form-control','required'=>'1')) }}					
                                </span>
						    </div>
						    <div>
						    	<span>{{ Form::label('comments', 'ASUNTO') }}</span>
						    	<span>
					
							{{ Form::textarea('comments', null, array('placeholder' => 'Comentarios', 'class' => 'form-control','required'=>'1')) }}	
                                
                                </span>
						    </div>
						   <div><label>
									<input type="checkbox"> Suscribirme al boletín semanal
								</label>
						   		<span>{{form::submit('Enviar', array('class'=>'btn btn-primary','id'=>'submitContacto'))}}</span>
						  </div>
					   <!-- </form>-->
                        
                        {{Form::close();}}
		
			@include ('errores', array('errores' => $errors ))
				    </div>
  				</div>		
  				<div class="clear"></div>		
		  </div>
</div>
</div>
</div>





@stop
@section('js')
	{{ HTML::style('assets/css/styles/pay.css', array('media' => 'screen')) }}
	<script src='https://www.google.com/recaptcha/api.js'></script>
@stop