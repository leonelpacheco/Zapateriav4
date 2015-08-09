<?php

class IndexController extends BaseController {

	public $menu;
	public $categorias;
	public $cart;
	/**
	*Constructor de la clase
	*/
	function __construct(){
		#creamos un objeto mnodelo de productos, solo usaremos el metodo selectm, para realizar consultas
		#se puede usar el objeto para despues modificar algo de la tabla productos
		$modelProductos = new ProductosPDO;
		#obtenemos las catgorias segun la consulta
		$categorias = $modelProductos->select("SELECT id,categoria FROM categorias WHERE mostrar=1");
		#este arreglo se usara para mostrar las categorias en el catalogo
		$this->categorias = $categorias;
		for ($i=0; $i < sizeof($categorias) ; $i++) { 
			#obtenemos las subcatgorias de la categoria actual
			$subcategorias = $modelProductos->select("SELECT id,subcategoria FROM subcategorias WHERE categoria_id=:id AND mostrar=1",array("id"=>$categorias[$i]['id'])); 
			$tSubcat = sizeof($subcategorias);
			#comprobamos que existan registros para agregar el array
			#if( $tSubcat > 0){
				for ($x=0; $x < $tSubcat ; $x++) { 
					#obtenemos los productos de la subcategoria actual
					$productos = $modelProductos->select("SELECT * FROM productos WHERE subcategoria_id = :id AND activo=1 ",array("id"=>$subcategorias[$x]['id']));
					#agregamos el areeglo productos al registro de la subcatgoria actual con sus productos
					$tPro = sizeof($productos);
					#comprobamos que existan registros para agregar el array
					#if ($tPro > 0) {
						$subcategorias[$x]['productos'] = $productos;
					#}	
				}
				#agregamos el arreglo subcategorias al registro categoria actual con sus subcategorias y productos agregados en ciclo anterior
				$categorias[$i]['subcategorias'] = $subcategorias;
			#}
		}
		$this->cart = Session::get('kart');
		$this->menu = $categorias;
	}
	/**
	 * Muesta la pagina de inicio
	 *
	 * @return Response
	 */
	#index, create, show y edit son métodos GET. 
	public function index()
	{
		$cart = $this->cart;
		$productos = Productos::where('activo','<>',0)->get();

		// User::where('votes', '>', 100)->firstOrFail();
		#$users = User::getAuthPassword(1);
		$index = "index";
		return View::make('index',compact('index','cart','productos'))->with('menu',$this->menu);
	}

	/**
	 * Muesta la pagina de servicios
	 *
	 * @return Response
	 */
	public function servicios(){
		$cart = $this->cart;
		$servicios = "open";
		return View::make('servicios',compact('servicios','cart'))->with('menu',$this->menu);
	}
	
	/**
	 * Muesta la pagina de servicios
	 *
	 * @return Response
	 */
	public function historia(){
		$cart = $this->cart;
		$historia = "open";
		return View::make('historia',compact('historia','cart'))->with('menu',$this->menu);
	}
	
	/**
	 * Muesta la pagina de servicios
	 *
	 * @return Response
	 */

	public function privacidad(){
		$cart = $this->cart;
		$privacidad = "open";
		return View::make('privacidad',compact('privacidad','cart'))->with('menu',$this->menu);
	}
	
	/**
	 * Muesta la pagina de servicios
	 *
	 * @return Response
	 */





	public function contacto(){
		$cart = $this->cart;
		$contacto = "open";
		return View::make('contacto',compact('contacto','cart'))->with('menu',$this->menu);
	}
	

	public function postContact(){
		$cart = $this->cart;
		$contacto = "open";

		$campos['nombre'] = Input::get('nombre');
		$campos['email'] = Input::get('email');
		$campos['telefono'] = Input::get('telefono');
		$campos['comments'] = Input::get('comments');
		$campos['captcha']=Input::get('captcha');
		$validacion=Validator::make($campos,
        [
            'nombre'	=>'required',
            'email'		=>'required',
            'telefono'	=>'required',
            'comments'	=>'required',
            'captcha'   =>'required|captcha',
           // 'g-recaptcha-response' => 'required|recaptcha'


        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }

$contactName = Input::get('nombre');
$contactEmail = Input::get('email');
$contactPhone = Input::get('telefono');
$contactMessage = Input::get('comments');

          $data = array('nombre'=>$contactName,'telefono'=>$contactPhone, 'email'=>$contactEmail, 'comments'=>$contactMessage);
			Mail::send('emails.contact', $data, function ($message)  {
			    $message->subject('Comentario desde Gruposiel.com');
			    $message->to('gbeto23@gmail.com');
			    });
		return View::make('contacto',compact('contacto','cart'))->with('menu',$this->menu,'message','Mensaje Enviado');

}

	/**
	 * Muesta el catalogo
	 *
	 * @return Response
	 */	
	public function catalogo(){
		$cart = $this->cart;
		$catalogo = "open";
		$categorias = $this->categorias;
		return View::make('catalogo',compact('catalogo','categorias','cart'))->with('menu',$this->menu);
	}


	/**
	*Funcion para confirmar la compra
	*/
	public function confirmCart(){
		$cart = $this->cart;
		return View::make('confirmPay',compact('cart'))->with('menu',$this->menu);
	}

	public function pagar(){
		$cart = $this->cart;
		return View::make('pay',compact('cart'))->with('menu',$this->menu);
	}
	/**
	*Funcion para mostrar un producto
	*/
	public function producto($id){
		$cart = $this->cart;
		$producto = Productos::find($id);
		if (!is_null($producto)) {
			$producto->toArray();
		}
		return View::make('producto',compact('cart','producto'))->with('menu',$this->menu);
	}

	/**
	*funcion para mostrar el login del cliente
	*/
	public function login(){
		$cart = $this->cart;
		return View::make('login',compact('cart'))->with('menu',$this->menu);
	}

	/**
	*Metodo que mostrara el formulario para registrar un cliente
	*/
	public function registrar(){
		$cart = $this->cart;
		$form_data = array('route' => array('saveCliente'), 'method' => 'post');
		$cliente = null;
		$titulo = 'Registrarme';
		$boton = 'Registrarme';
		return View::make('registrar',compact('cart','form_data','cliente','titulo','boton'))->with('menu',$this->menu);	
	}

	/**
	*Metodo para editar un cliente
	*/
	public function editarCuenta(){
		$cart = $this->cart;
		if(Session::has('datosCliente')){
			$aDatCliente = Session::get('datosCliente');
			$modelClientes = new ClientesPDO;
			$arrCliente = $modelClientes->find('id',$aDatCliente[0]['id']);
			
			$cliente = $arrCliente[0];
			$titulo = 'Editar cuenta';
			$boton = 'Guardar';
			$form_data = array('route' => array('editarCliente'), 'method' => 'post');
			return View::make('registrar',compact('cliente','cart','form_data','titulo','boton'))->with('menu',$this->menu);
		}else{
			return Redirect::to('/login');
		}
	}

	public function recuperarContrasena(){
		$cart = $this->cart;
		return View::make('recuperarContrasena',compact('cart'))->with('menu',$this->menu);	
	}

	public function enviarContrasena(){
		$data = array('nombre' => 'David Calva' );;
		Mail::send('emails.resetContrasena', $data, function ($message) {
		    $message->subject('Aqui va el mensaje del asunto del email ');
		    $message->to('davi619@hotmail.com');
		});
		echo "string";
	}
}