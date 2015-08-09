<?php  
/**
* 
*/
class ErrorController extends BaseController
{
	public function index($codigo){

		$codigos = array('default' => 'Lo sentimos ocurrio un errror.',
						 '400' => 'Petición erronea.',
					 	 '401' => 'No autorizado.',
					 	 '403' => 'Prohibido.',
					 	 '404' => 'Recurso no encontrado o no disponible.',
					 	 '405' => 'Método no permitido.');
		$error = $codigo.": ".$codigos[$codigo];
		return View::make('error')->with('error',$error);
	}
}
?>