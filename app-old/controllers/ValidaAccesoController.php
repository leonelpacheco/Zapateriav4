<?php  

/**
* 
*/
class ValidaAccesoController 
{
	/**De acuerdo a los controladores el metodo index(), create() y show() debera validar permisos de lectura
	*otros metodos como create(),store(),edit(),update() y destroy() deberan validar permisos de escritura
	*/

	/**
	*Funcion que valida el acceso a los modulos cuando se hace peticiones normales
	*recibe el mAlias(alias del modulo) y el permiso que desea valida (lectura o escritura)
	*este metodo solo valida las peticines sincronas
	*/
	public static function validarAcceso($mAlias,$permiso){
		
		$tiempo = time() - Session::get('tiempoInicio');
		if( $tiempo > (60*60) ){
			Session::forget('modulosAcceso');
			Session::forget('tiempoInicio');
			Session::forget('datosUsuario');
			#Session::flush();
			Auth::logout();
			header('Location: '.route('loginIndex'));
		    exit;
		}
		#comprobar el token para proteccion csrf
		if('escritura' == strtolower($permiso) && $_SERVER['REQUEST_METHOD'] != 'GET' ){
			if (Session::token() != Input::get('_token')){
				echo "Error: Accion no permitida ->".Input::get('_token');
				exit;
			}
		}
		#comprobamos que exista el arreglo de accesos
		if (Session::has('modulosAcceso'))
		{
			$accesos = Session::get('modulosAcceso');
		    #si encontramos el modulo en el arreglo de accesos tiene permisos al modulo
		    if(array_key_exists($mAlias, $accesos)){
		    	if($accesos[$mAlias][$permiso] == 1){#validamos los permisos
		    		return;
		    	}else{#no tiene permiso
		    		header('Location: '.route('ErrorIndex','401' ));
		    		exit;
		    	}
		    }else{#no se tiene acceso al modulo
		    	header('Location: '.route('ErrorIndex','401' ));
		    	exit;
		    }
		}else
		{#no se ha inciado sesion
			header('Location: '.route('loginIndex') );
			exit;
		}
	}
	/**
	*Funcion que valida el acceso a los modulos cuando se hace peticines ajax
	*recibe el modulo y el permiso que desea valida (lestura o escritura)
	*este metodo solo valida las peticines sincronas
	*/
	public static function validarAccesoAjax($modulo,$permiso){
		#comprobamos que exista el arreglo de accesos
		if (Session::has('modulosAcceso'))
		{
			$accesos = Session::get('modulosAcceso');
		    #si encontramos el modulo en el arreglo de accesos tiene permisos al modulo
		    if(array_key_exists($modulo, $accesos)){
		    	if($accesos[$modulo][$permiso] == 1){#validamos los permisos
		    		return;
		    	}else{#no tiene permiso
		    		header('Location: '.route('ErrorIndex','401' ));
		    		exit;
		    	}
		    }else{#no se tiene acceso al modulo
		    	header('Location: '.route('ErrorIndex','401' ));
		    	exit;
		    }
		}else
		{#no se ha inciado sesion
			header('Location: '.route('loginIndex') );
			exit;
		}
	}
}

?>