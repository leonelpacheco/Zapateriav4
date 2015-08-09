<?php  
/**
* 
*/
class ClientePedidosController extends BaseController
{
	private $arrProductosNoStock;
	
	public function savePedido(){
		$cart = Session::get('kart');
		if (empty($cart)) {
			return Redirect::to('/');
		}
		DB::transaction(function(){
			
			$productos    = null;
			$invitado     = Input::get('invitado');
			$fecha        = date("Y-m-d H:i:s");
			$datosCliente = Session::get('datosCliente');
			$cliente_id   = ( Session::has('datosCliente') ) ? $datosCliente[0]['id'] : null;
			$email = Input::get('email');		
			#si no es invitado
			if( ! $invitado ){
				# comprobamos que no este logeado para guardar el cliente
				if( ! Session::has('datosCliente') ){
					$arrCliente = array(
										'nombres'      => Input::get('nombre'), 
										'apellidos'    => Input::get('apellidos'), 
										'email'        => $email,#Input::get('email'), 
										'telefono'     => Input::get('telefono'), 
										'password'     => Input::get('password_registro'), 
										'empresa'      => Input::get('empresa'), 
										'rfc'          => Input::get('rfc'), 
										'calleNum'     => Input::get('calle'), 
										'colonia'      => Input::get('colonia'), 
										'ciudad'       => Input::get('ciudad'), 
										'estado'       => Input::get('estado'), 
										'pais'         => Input::get('pais'), 
										'codigopostal' => Input::get('codigoPostal')
										);
					#guardar el cliente
					$cliente_id = DB::table('clientes')->insertGetId($arrCliente);
				}
			}
			#guardar pedido, 
			$pedido_id = DB::table('pedidos')->insertGetId(
			    array('fecha_pedido' => $fecha, 'fecha_atendido' => '0000-00-00 0000:00' ,'fecha_atendido' => '0000-00-00 0000:00','estado' => 0,'cliente_id' => $cliente_id)
			);
			# guardar pedidosproductos , pedidoInformacion
			$productos = Session::get('kart');
			foreach ($productos as $producto) { 
				DB::table('pedidosproductos')->insert(
					array('pedido_id' => $pedido_id, 'producto_id' => $producto['id'], 'num_productos' => $producto['cantidad'], 'precio' => $producto['precio'] )
				);
			}
			#insertar la informacion del pedido
			$arrPedidoInfo = array(
							'pedido_id'        => $pedido_id,
							'formaEnvio'       => Input::get('formaEnvio'),
							'formaPago'        => Input::get('formaPago'),
							'comentarioPedido' => Input::get('comentarioPedido'),
							'comentarioEnvio'  => Input::get('comentarioEnvio'),
							'nombresCliente'   => Input::get('nombre'), 
							'apellidos'        => Input::get('apellidos'), 
							'email'            => $email,#Input::get('email'),  
							'telefono'         => Input::get('telefono'), 
							'empresa'          => Input::get('empresa'), 
							'rfc'              => Input::get('rfc'), 
							'calleNum'         => Input::get('calleEnvio'), 
							'colonia'          => Input::get('coloniaEnvio'), 
							'ciudad'           => Input::get('ciudadEnvio'), 
							'estado'           => Input::get('estadoEnvio'), 
							'pais'             => Input::get('paisEnvio'), 
							'codigopostal'     => Input::get('codigoPostalEnvio')
						);
			DB::table('pedidoinformacion')->insert($arrPedidoInfo);
			
			$productos = Session::get('kart');
			#array que gradara los productos que no estan disponibles en el stock inmediatamente
			$this->arrProductosNoStock = array();
			$productosStock = array();
			foreach ( $productos as $producto ) {
				$stockProducto = DB::table('productos')->where('id',$producto['id'])->first();
				$productosStoc[] = array('id' => $stockProducto->id, 'cantidad', $stockProducto->cantidad ); 
				if ($stockProducto->cantidad < $producto['cantidad']) {
					$this->arrProductosNoStock[] = array(
												   'producto'        => $stockProducto->producto, 
												   'stockDisponible' => $stockProducto->cantidad, 
												   'cantidadPedida'  => $producto['cantidad'] 
											);
				}
				#se obtiene el nuevo stock de los productos en existencia#
				$newStock = $stockProducto->cantidad - $producto['cantidad'];
				#se valida que el stock no sea negativo, si lo es se iguala a cero#
				$newStock = ($newStock < 0 ) ? 0 : $newStock;
				DB::table('productos')->where('id',$stockProducto->id)->update( array( 'cantidad' => $newStock ) );
			}
			
			$data = array('productos' => array_values($productos), 'noStock' => $this->arrProductosNoStock);
			Mail::send('emails.emailPedido', $data, function ($message) {
			    $message->subject('Informacion de su compra');
			    $message->to(Input::get('email'));
			});
		});
		$cart = null;#Session::get('kart');
		Session::put('kart', null);
		return View::make('pedidoDetalles',compact('cart'))->with('arrProductosNoStock', $this->arrProductosNoStock );
		
	}

	public function validaEmail(){
		$email = Input::get('email');
		$modelClientes = new ClientesPDO;

		$cliente = $modelClientes->find('email',$email);
		#el cliente existe, 0 ok 
		$response['status'] = ( $cliente ) ? 1 : 0 ; 
		$response['msj']    = ( $cliente ) ? 'El email ya esta en uso' : 'ok' ; 


		echo json_encode($response);
	}

	public function saveCliente(){
		
		if( ! Session::has('datosCliente') ){
			
			$arrCliente = array(
								'nombres'      => Input::get('nombre'), 
								'apellidos'    => Input::get('apellidos'), 
								'email'        => Input::get('email'), 
								'telefono'     => Input::get('telefono'), 
								'password'     => Input::get('password_registro'), 
								'empresa'      => Input::get('empresa'), 
								'rfc'          => Input::get('rfc'), 
								'calleNum'     => Input::get('calle'), 
								'colonia'      => Input::get('colonia'), 
								'ciudad'       => Input::get('ciudad'), 
								'estado'       => Input::get('estado'), 
								'pais'         => Input::get('pais'), 
								'codigopostal' => Input::get('codigoPostal')
								);
			#guardar el cliente
			$cliente_id = DB::table('clientes')->insertGetId($arrCliente);
			//echo "cliente guardado";
			return Redirect::to('/login');
		}

	}

	public function editarCliente(){
		if (Session::token() != Input::get('_token')){
			echo "Error: Accion no permitida";
			exit;
		}
		if( Session::has('datosCliente') ){
			$modelClientes = new ClientesPDO;
			$cliente = $modelClientes->find('email',Input::get('emailHide'));
			$cliente_id = $cliente[0]['id'];
			$arrCliente = array(
								'nombres'      => Input::get('nombre'), 
								'apellidos'    => Input::get('apellidos'), 
								'email'        => Input::get('email'), 
								'telefono'     => Input::get('telefono'), 
								'password'     => Input::get('password_registro'), 
								'empresa'      => Input::get('empresa'), 
								'rfc'          => Input::get('rfc'), 
								'calleNum'     => Input::get('calle'), 
								'colonia'      => Input::get('colonia'), 
								'ciudad'       => Input::get('ciudad'), 
								'estado'       => Input::get('estado'), 
								'pais'         => Input::get('pais'), 
								'codigopostal' => Input::get('codigoPostal')
								);
			DB::table('clientes')->where('id',$cliente_id)->update($arrCliente);
			$cliente = $modelClientes->find('id',$cliente_id);
			Session::forget('datosCliente');
			Session::put('datosCliente', $cliente);
			return Redirect::to('/editarCuenta')->with('div','<p class="bg-success">Sus datos se guardaron correctamente</p>');
		}

	}
}
?>