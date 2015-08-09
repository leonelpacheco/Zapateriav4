<?php

class PedidosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//ValidaAccesoController::validarAcceso('pedidos','lectura');
		
		$modelPedidos = new PedidosPDO();
		#$arr = $pedidos->select("SELECT * FROM pedidos WHERE usuario_id = :id", array("id"=>"1"));
		
		if (Session::get('datosUsuario.perfil') == 'administrador' ) {
			#$pedidos = Pedidos::all()->byUsuario;#->allByUsuario();
			$columnas = array( 'estado' => 'Estado', 'nombres' => 'Cliente' );
			$pedidos = $modelPedidos->select("SELECT p.id,p.fecha_pedido,p.estado,c.nombres 
											  FROM pedidos p
											  INNER JOIN clientes c on p.cliente_id=c.id ");
			
		}else{
			$cliente = Session::get('datosCliente');

			$pedidos = $modelPedidos->select("SELECT p.id,p.fecha_pedido,p.estado,c.nombres 
											  FROM pedidos p
											  INNER JOIN clientes c on p.cliente_id=c.id
											  WHERE p.cliente_id = :id ", array("id"=>$cliente[0]['id']));
			
			$columnas = array( 'estado' => 'Estado', 'fecha_pedido' => 'Fecha' );


		}
		$pedidos = ( is_null($pedidos) || sizeof($pedidos) <1 ) ? null :  MyHps::toArray( $pedidos );
		
		$pedidos = MyHps::estadoPedido( $pedidos ,'estado'  );
		
		$data = array('pedidos' => $pedidos, 'columnas' => $columnas );
		$view = (Session::has('datosCliente')) ? 'pedidosCliente': 'admin/pedidosIndex';
		$cart = Session::get('kart');
		return View::make( $view,compact('cart') )->with('data', $data);
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//ValidaAccesoController::validarAcceso('pedidos','escritura');
		$perfil = Perfiles::where('perfil','=','cliente')->get();
		if(is_null($perfil)){
			return Redirect::route('ErrorIndex','default');
		}
		$perfil = $perfil->toArray();
		
		$clientes = Usuarios::where('perfil_id','=',$perfil[0]['id'])->get();
		if(is_null($clientes)){
			return Redirect::route('ErrorIndex','default');
		}
		$clientes = $clientes->toArray();
		
		$productos = Productos::all();

		$form_data = array('route' => array('pedidos.store'), 'method' => 'post');
        $action    = 'Crear';
        $pedido = null;
		return View::make('admin/pedido',compact('pedido','form_data','action','clientes','productos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
		# estado = 0 ->>pendiente, 1->enviado atendido o algo similar, 2->entregado
		//ValidaAccesoController::validarAcceso('pedidos','escritura');
		$cliente   = $_POST['cliente'];
		$rules = array(
			'cliente'   => 'required|integer'
		);
		$validator = Validator::make( array('cliente' => $cliente ),$rules);

		if($validator->fails()){
			return Redirect::route('pedidos.create')->withInput()->withErrors($validator->errors());
		}else{
			DB::transaction(function()
			{
				#dos primeros campos son ids
				$productos = $_POST['productos'];
				$cliente   = $_POST['cliente'];
				$cantidad  = $_POST['cantidad'];
				$fecha     = date("Y-m-d H:i:s");
				$id = DB::table('pedidos')->insertGetId(
				    array('fecha_pedido' => $fecha, 'fecha_atendido' => '0000-00-00 0000:00' ,'fecha_atendido' => '0000-00-00 0000:00','estado' => 0,'usuario_id' => $cliente)
				);
				for ($i=0; $i < sizeof($productos); $i++) { 
					DB::table('pedidosproductos')->insert(
						array('pedido_id' => $id, 'producto_id' => $productos[$i], 'num_productos' => $cantidad[$i])
					);
				}
			});
			return Redirect::route('pedidos.index');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//ValidaAccesoController::validarAcceso('pedidos','lectura');
		$cart = Session::get('kart');
		$pedidos = new PedidosPDO();
		$arrPedidos = $pedidos->select("SELECT c.email,c.id idUser,p.id idPedido,pr.id idProducto, pr.producto,pp.num_productos,pr.precio_inicial precio,p.estado 
								FROM clientes c
								inner join pedidos p on p.cliente_id=c.id 
								inner join pedidosproductos pp on p.id=pp.pedido_id
								inner join productos pr on pr.id=pp.producto_id
								WHERE p.id=:id and p.estado = 0 "
								, array("id"=>$id));
		$menu = null;
		$form_data = array('route' => array('pedidos.update',$id), 'method' => 'get');
        if(Session::has('datosCliente')){
        	return View::make('pedido',compact('arrPedidos','form_data','cart','menu'));
        }else{
        	return View::make('admin/pedidoEdit',compact('arrPedidos','form_data'));
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//ValidaAccesoController::validarAcceso('pedidos','escritura');
		$pedidos = new PedidosPDO();
		$arrPedidos = $pedidos->select("SELECT u.email,u.id idUser,p.id idPedido,pr.id idProducto, pr.producto,pp.num_productos,pr.precio_inicial precio,p.estado FROM usuarios u
								inner join pedidos p on p.usuario_id=u.id 
								inner join pedidosproductos pp on p.id=pp.pedido_id
								inner join productos pr on pr.id=pp.producto_id
								WHERE p.id=:id and p.estado = 0 "
								, array("id"=>$id));
		
		$form_data = array('route' => array('pedidos.update',$id), 'method' => 'PUT');
        
		return View::make('admin/pedidoEdit',compact('arrPedidos','form_data'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//ValidaAccesoController::validarAcceso('pedidos','escritura');
		$modelPedidos = new PedidosPDO();
		//echo "string";
		$resp = $modelPedidos->update( array('estado' => $_POST['estado'] ),$id);
		//echo $resp;
		//exit;
		if($resp == 0){
			#actualizacion correcta
			return Redirect::route('pedidos.index');
		}else{
			/*a qui mandar errores si es que existen */
			return Redirect::route('pedidos.edit',$id)->withInput()->withErrors(array('Ocurrio un problema... porfavor contacte al administrador'.$resp));
			#echo "No se actulizo el registro" .$resp;
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}