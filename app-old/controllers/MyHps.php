<?php 
/**
* 
*/
class MyHps 
{
	//Entrada: OBJECT|ARRAY
	//Salida: Si el valor ingresado es un objeto o un array devuelve un array, en caso contrario devuelve el valor con su valor de entrada.
	//Autor: dantepiazza
	//Versión: 1.0
	public static function toArray($valor){
		if(!@is_array($valor) and !@is_object($valor)){
			return $valor;
		}
		else{
			foreach($valor as $key => $cadena){
				$valores[$key] = self::toArray($cadena);
			}
		}
		return $valores;
	}
	/**
	*funcion que cambia el valor de una columna de una consulta obtenida
	* recibe el arreglo de la consulta
	* $col -> el nombre de la columna que se va a cambiar
	*/
	public static function estadoPedido($arr,$col){
		for ($i=0; $i < sizeof($arr); $i++) { 
			#estado: pendiente 
			if( $arr[$i][$col] == 0 ){
				$arr[$i][$col]  = '<img alt="pendiente" src="assets/img/pendiente.jpg" >';
			}
			#estado: atendido
			if( $arr[$i][$col] == 1 ){
				$arr[$i][$col]  = '<img alt="enviado" src="assets/img/atendido.jpg" >';
			}
			#estado: entregado 
			if( $arr[$i][$col] == 2 ){
				$arr[$i][$col]  = '<img alt="entregado" src="assets/img/entegado.jpg" >';
			}
		}
		return $arr;
	}
	
}
?>