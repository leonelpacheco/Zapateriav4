<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|

/**
*rutas a recursos controladores
*/
Route::resource('usuarios', 'UsuariosController');
Route::resource('productos', 'ProductosController');
/*obtener las subcategorias por categoria*/
Route::post('subcategorias/getSubcategoriasByCategoria',function(){
	$categoria_id = $_POST['categoria_id'];
	$modelProductos = new ProductosPDO;

	$subcategorias = $modelProductos->select("SELECT subcategoria,id from subcategorias WHERE categoria_id = :id",array("id" => $categoria_id)); 
	echo json_encode($subcategorias);
});
Route::resource('categorias', 'CategoriasController');
Route::resource('subcategorias', 'SubcategoriasController');
Route::resource('pedidos', 'PedidosController');
Route::resource('proveedores', 'ProveedoresController');


Route::get('/pagos', array('uses' => 'PagosController@index',
                                        'as' => 'pagos.index'));

/*peticiones para el carrito de compras*/
Route::post('/Cartpush', array( 'uses'=>'KartController@push',
										'as'=>'cartPush'));
Route::post('/Cartpop', array( 'uses'=>'KartController@pop',
										'as'=>'cartPop'));
Route::post('/CartUpdate', array( 'uses'=>'KartController@update',
										'as'=>'cartUpdate'));


/*frontend*/
Route::get('/', array( 'uses'=>'IndexController@index',
										'as'=>'index'));
Route::get('/servicios', array( 'uses'=>'IndexController@servicios',
										'as'=>'servicios'));

Route::get('/contacto', array( 'uses'=>'IndexController@contacto',
										'as'=>'contacto'));



Route::get('/catalogo',array('uses'=>'CatalogoController@buscar',
										'as'=>'buscar'));
Route::post('/contacto', array('uses'=>'IndexController@postContact',
										'as'=>'postContact'));

Route::get('/privacidad', array('uses'=>'IndexController@privacidad',
										'as'=>'privacidad'));
Route::get('/historia', array('uses'=>'IndexController@historia',
										'as'=>'historia'));
Route::get('/catalogo', array( 'uses'=>'IndexController@catalogo',
										'as'=>'catalogo'));
Route::get('/editarCuenta', array( 'uses'=>'IndexController@editarCuenta',
										'as'=>'editarCuenta'));
Route::get('/recuperarContrasena', array( 'uses'=>'IndexController@recuperarContrasena',
										'as'=>'recuperarContrasena'));
Route::get('/enviarContrasena', array( 'uses'=>'IndexController@enviarContrasena',
										'as'=>'enviarContrasena'));
/*rutas para el pago*/
Route::get('/confirmPay', array( 'uses'=>'IndexController@confirmCart',
										'as'=>'confirmPay'));
Route::get('/producto/{id}', array( 'uses'=>'IndexController@producto',
										'as'=>'producto'));
Route::get('/pay', array( 'uses'=>'IndexController@pagar',
										'as'=>'pay'));
Route::get('/login', array('uses' => 'IndexController@login',
                                        'as' => 'loginCliente'));

Route::get('/registroCliente', array('uses' => 'IndexController@registrar',
                                        'as' => 'registrarCliente'));

Route::post('/saveCliente', array( 'uses'=>'ClientePedidosController@saveCliente',
										'as'=>'saveCliente'));
Route::post('/editarCliente', array( 'uses'=>'ClientePedidosController@editarCliente',
										'as'=>'editarCliente'));
Route::post('/savePedido', array( 'uses'=>'ClientePedidosController@savePedido',
										'as'=>'savePedido'));
Route::post('/savePedido/validarEmail', array( 'uses'=>'ClientePedidosController@validaEmail',
										'as'=>'validaEmail'));
/*obtenemos los productos por categoria/s*/
Route::post('/catalogo/getByCategorias', array( 'uses'=>'CatalogoController@getByCategorias',
										'as'=>'getByCategorias'));
/*obtenemos los productos por subcategoria/s*/
Route::post('/catalogo/getBySubcategoria', array( 'uses'=>'CatalogoController@getBySubcategoria',
										'as'=>'getBySubcategoria'));

/**
*Routes para el login 
*/
Route::get('/admin', array('uses' => 'LoginController@index',
                                        'as' => 'loginIndex'));

Route::post('/admin', array('uses' => 'LoginController@doLogin',
                                        'as' => 'doLogin'));


Route::get('/login/logout', array('uses' => 'LoginClientesController@logOut',
                                        'as' => 'logout'));

Route::post('/dologin', array('uses' => 'LoginClientesController@doLogin',
                                        'as' => 'doLoginCliente'));

/**
*Routes para el panel de administracion
*/
Route::get('admin/panelAdmin',array('uses' => 'PanelAdminController@index' ,
										'as' => 'panelAdmin' ));

Route::get('/error/{codigo}', array('uses' => 'ErrorController@index',
                                        'as' => 'ErrorIndex'));

Route::get('/payment', array(
    'as' => 'payment',
    'uses' => 'PaypalController@postPayment',
));

// this is after make the payment, PayPal redirect back to your site
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));











//Route::resource('user/{id}', 'IndexControllerRestfull');
#Route::get('user/{id}', array('as' => 'user', 'uses' => 'IndexControllerRestfull'));
#Route::get('user', array('as' => 'nuevo', 'uses' => 'IndexControllerRestfull@create'));
/*Route::get('/', function()
{
	#return View::make('inicio');
	return "holaaa";
});


Route::get('lalala', function()
{
    return "lalala";
});*/

//Route::resource('/', 'IndexController@index');
//Route::get('/{name}', 'IndexController@index');
//Route::get('/', 'IndexController@index');