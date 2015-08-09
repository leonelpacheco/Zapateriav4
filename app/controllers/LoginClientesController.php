<?php
/**
* 
*/
class LoginClientesController extends BaseController
{
	
	public function doLogin(){

		
		$email = Input::get('email');
		$pass  = Input::get('password');
		$response = array(
			'status'  => 1,
			'msj'     => '',
			'cliente' => array() 
		); 
		if( !empty($email) && !empty($pass) ){
			$modelClientes = new ClientesPDO;
			$cliente = $modelClientes->find('email',$email);
			if( $cliente ){
				$password = $cliente[0]['password'];
				if( $password == $pass ){
					$response['status'] = 0;
					$response['msj']    = 'Ok';
					$response['cliente'] = $cliente[0];
					$response['redirect'] = 'catalogo';

					$arrModulos['pedidos'] = array('lectura'   => 1,
                                                   'escritura' => 0
                                            ); 
					Session::put('modulosAcceso', $arrModulos);
					Session::put('tiempoInicio', time());
					Session::put('datosCliente', $cliente);
				}else{
					$response['msj'] = 'La contraseña y/o email son incorrectos.';
				}
			}else{
				$response['msj'] = 'La contraseña y/o email son incorrectos.';	
			}

		}else{
			$response['msj'] = 'Los campos email y contraseña son obligatorios';
		}

		echo json_encode($response);
	}

	public function logOut(){
		Session::forget('datosCliente');
		$response = array(
			'status'  => 0,
			'msj'     => 'Ok' 
		);
		//echo json_encode($response);
		return Redirect::to('/');
	}


//====================================================
public function doLogin2(){

		
		$email = Input::get('email');
		$pass  = Input::get('password');
		$response = array(
			'status'  => 1,
			'msj'     => '',
			'cliente' => array() 
		); 
		if( !empty($email) && !empty($pass) ){
			$modelClientes = new ClientesPDO;
			$cliente = $modelClientes->find('email',$email);
			if( $cliente ){
				$password = $cliente[0]['password'];
				if( $password == $pass ){
					$response['status'] = 0;
					$response['msj']    = 'Ok';
					$response['cliente'] = $cliente[0];
					$response['redirect'] = 'catalogo';

					$arrModulos['pedidos'] = array('lectura'   => 1,
                                                   'escritura' => 0
                                            ); 
					Session::put('modulosAcceso', $arrModulos);
					Session::put('tiempoInicio', time());
					Session::put('datosCliente', $cliente);
					return Redirect::to('catalogo');
				}else{
					$response['msj'] = 'La contraseña y/o email son incorrectos.';
				}
			}else{
				$response['msj'] = 'La contraseña y/o email son incorrectos.';	
			}

		}else{
			$response['msj'] = 'Los campos email y contraseña son obligatorios';
		}

		echo json_encode($response);
	}





}
?>