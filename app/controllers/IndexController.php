<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class IndexController extends BaseController {

	public $menu;
	public $categorias;
	public $cart;
	/**
	*Constructor de la clase
	*/
	function __construct(){


		        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
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
	

		public function comentario(){
		$cart = $this->cart;
		$contacto = "open";
		return View::make('comentario',compact('comentario','cart'))->with('menu',$this->menu);
	}

	public function postContact(){
		$cart = $this->cart;
		$contacto = "open";

		$campos['nombre'] = Input::get('nombre');
		$campos['email'] = Input::get('email');
		$campos['telefono'] = Input::get('telefono');
		$campos['comments'] = Input::get('comments');
		//$campos['captcha']=Input::get('captcha');
		$validacion=Validator::make($campos,[
            'nombre'	=>'required',
            'email'		=>'required',
            'telefono'	=>'required',
            'comments'	=>'required',
            //'captcha'   =>'required|captcha',
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
			    $message->subject('Comentario desde ');
			    $message->to('jmvarguez@gmail.com');
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
		    $message->to('jmvarguez@hotmail.com');
		});
		echo "string";
	}
	
	/*******/
		/**
	*Metodo que devuelve todos los productos de un categoria
	*/
	public function getByCategorias(){
		#total de categorias
		$categorias = Input::get('categorias');
		$query = "SELECT p.*,s.subcategoria FROM productos p 
				INNER JOIN subcategorias s ON p.subcategoria_id = s.id
				INNER JOIN categorias c ON s.categoria_id = c.id ";
		$sWhere      = "";
		$sWhereSub   = "";
		$nCategorias = sizeof($categorias);
		$arrParams   = array();
		#si son mas de una categoria armamos el query
		if( $nCategorias > 1 ){
			$sWhere    = " WHERE ";
			$sWhereSub = " WHERE ";
			for ($i=0; $i < $nCategorias; $i++) { 
				$sWhere    .= " c.id = :id" .$i . " OR ";
				$sWhereSub .= " categoria_id = :id" .$i . " OR ";
				$arrParams['id'.$i] = $categorias[$i];
			}
			$sWhere    = substr($sWhere, 0, -3);
			$sWhereSub = substr($sWhereSub, 0, -3);
		#si es solo uno se establece sin mas problema
		}elseif ( $nCategorias==1 ) {
			$sWhere = " WHERE c.id = :id0";
			$sWhereSub = " WHERE categoria_id = :id0";
			$arrParams['id0'] = $categorias[0];
		}
		$query .= $sWhere;
		$result['productos']     = $this->modelProductos->select($query,$arrParams);
		$result['subcategorias'] = $this->modelProductos->select('SELECT id,subcategoria FROM subcategorias ' .$sWhereSub,$arrParams);
		echo json_encode($result);
	}


	/**
	*Metodo que devuelve todos los productos de una Subcategoria
	*/
	public function getBySubcategoria(){

		$subcategoria = Input::get('subcategoria');
		$query = "SELECT p.*,s.subcategoria FROM productos p 
				INNER JOIN subcategorias s ON p.subcategoria_id = s.id
				INNER JOIN categorias c ON s.categoria_id = c.id
				WHERE s.id = :id";
		$productos = $this->modelProductos->select($query,array('id' => $subcategoria));
		echo json_encode($productos);
	
}

	public function buscar(){
		$buscar=htmlspecialchars(Input::get('buscar')); 
		
				
		
		$categorias= Categorias::where('categorias','LIKE', '%'.$buscar.'%')->get();



		
			
		
	}

//==================PAYPAL========================================

public function postpayment()
{
    

    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $item_1 = new Item();
$total=0;

        //se obtienen todos los productos
        $item_list = new ItemList();
    $productos = Session::get('kart');
    foreach ($productos as $producto) { 
			$item_1 = new Item();
		    $item_1->setName($producto['producto']) // item name
		        ->setCurrency('MXN')
		        ->setQuantity($producto['cantidad'])
		        ->setPrice($producto['precio']); // unit price

		        $total += ($producto['precio']*$producto['cantidad']);
		      
		        $array[] = $item_1;
			}
			  $item_list->setItems($array);
  /* 
    $item_1->setName('Item 1') // item name
        ->setCurrency('MXN')
        ->setQuantity(2)
        ->setPrice('15'); // unit price

    $item_2 = new Item();
    $item_2->setName('Item 2')
        ->setCurrency('MXN')
        ->setQuantity(4)
        ->setPrice('7');

    $item_3 = new Item();
    $item_3->setName('Item 3')
        ->setCurrency('MXN')
        ->setQuantity(1)
        ->setPrice('20');

*/


    // add item to list
    //$item_list = new ItemList();
    //$item_list->setItems(array($item_1, $item_2, $item_3));

    $amount = new Amount();
    $amount->setCurrency('MXN')
        //->setTotal(248);
    ->setTotal($total);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($item_list)
        ->setDescription('Your transaction description');

    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl(URL::route('payment.status'))
        ->setCancelUrl(URL::route('payment.status'));

    $payment = new Payment();
    $payment->setIntent('Sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));

    try {
        $payment->create($this->_api_context);
    } catch (\PayPal\Exception\PPConnectionException $ex) {
        if (\Config::get('app.debug')) {
            echo "Exception: " . $ex->getMessage() . PHP_EOL;
            $err_data = json_decode($ex->getData(), true);
            exit;
        } else {
            die('Some error occur, sorry for inconvenient');
        }
    }

    foreach($payment->getLinks() as $link) {
        if($link->getRel() == 'approval_url') {
            $redirect_url = $link->getHref();
            break;
        }
    }

    // add payment ID to session
    Session::put('paypal_payment_id', $payment->getId());

    if(isset($redirect_url)) {
        // redirect to paypal
        return Redirect::away($redirect_url);
    }

    return Redirect::route('original.route')
        ->with('error', 'Unknown error occurred');
}



public function getPaymentStatus()
{
    // Get the payment ID before session clear
    $payment_id = Session::get('paypal_payment_id');

    // clear the session payment ID
    Session::forget('paypal_payment_id');

    if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
        return Redirect::route('original.route')
            ->with('error', 'Payment failed');
    }

    $payment = Payment::get($payment_id, $this->_api_context);

    // PaymentExecution object includes information necessary 
    // to execute a PayPal account payment. 
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId(Input::get('PayerID'));

    //Execute the payment
    $result = $payment->execute($execution, $this->_api_context);

    echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

    if ($result->getState() == 'approved') { // payment made
        return Redirect::route('original.route')
            ->with('success', 'Payment success');
    }
    return Redirect::route('original.route')
        ->with('error', 'Payment failed');
}
//===================================================================	



}//Fin de clase