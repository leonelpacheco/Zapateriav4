<?php  
/**
* 
*/
class KartController extends BaseController
{
	/**
	*Funcion que servira para agregar productos al carrito de compra
	*/
	public function push(){
		#obtener los productos de la variables de sesion
		$arrKart     = Session::get('kart');
		$arrIds      = Session::get('idsProductos');
		$id_producto = Input::get('id');
		$cantidad    = Input::get('cantidad');
		$rutaImg     = Input::get('img');
		#comprobar que tenga productos el carrito
		if(!empty($arrKart) && !empty($arrIds)){
			#si ya existe el producto solamente agregamos a la cantidad
			if(in_array($id_producto, $arrIds)){
				$arrKart[$id_producto]['cantidad'] += $cantidad;
			}else{#si no agregamos el producto
				$producto = array(
						'id'       => $id_producto,
						'producto' => Input::get('producto'),
						'precio'   => str_replace(",","",Input::get('precio')),
						'cantidad' => $cantidad,
						'img'      => $rutaImg
					);
				$arrKart[$id_producto] = $producto;
				$arrIds[] = $id_producto;

			}
			Session::put('idsProductos',$arrIds);
			Session::put('kart',$arrKart);
		}else{
			$producto = array(
						'id'       => $id_producto,
						'producto' => Input::get('producto'),
						'precio'   => str_replace(",","",Input::get('precio')),
						'cantidad' => $cantidad,
						'img'      => $rutaImg
					);
			$arrKart[$id_producto] = $producto;
			$arrIds[] = $id_producto;
			Session::put('kart',$arrKart);
			Session::put('idsProductos',$arrIds);
		}
		$productos = Session::get('kart');
		
		echo json_encode(array_values($productos));
		
	}

	/**
	*Funcion que servira para quitar productos al carrito de compra
	*/
	public function pop(){
		$arrKart     = Session::get('kart');
		$arrIds      = Session::get('idsProductos');
		$id_producto = Input::get('id');
		if(!empty($arrKart) && !empty($arrIds)){
			if(in_array($id_producto, $arrIds)){
				//$arrKart[$id_producto]['cantidad'] += $cantidad;
				$key = array_search($id_producto, $arrIds);
				unset($arrKart[$id_producto]);
				unset($arrIds[$key]);
			}else{#si no agregamos el producto
				//echo "No se encontro el producto";
			}
		}else{
			//echo "No se encontro el producto";
		}
		Session::put('idsProductos',$arrIds);
		Session::put('kart',$arrKart);

		$productos = Session::get('kart');
		
		echo json_encode(array_values($productos));
	}

	/**
	*Funcion que servira para actualizar la cantidad de productos
	*/
	public function update(){
		$arrKart     = Session::get('kart');
		$arrIds      = Session::get('idsProductos');
		$cantidad    = Input::get('cantidad');
		$id_producto = Input::get('id');
		//echo "cantidad".$cantidad;
		if(!empty($arrKart) && !empty($arrIds)){
			if(in_array($id_producto, $arrIds)){
				//$arrKart[$id_producto]['cantidad'] += $cantidad;
				if($cantidad == 0){
					//echo "string";
					$key = array_search($id_producto,$arrIds);
					unset($arrKart[$key]);
					unset($arrIds[$key]);
				}else{
					$arrKart[$id_producto]['cantidad'] = $cantidad;
				}
			}else{#si no agregamos el producto
				#echo "No se encontro el producto";
			}
		}else{
			#echo "No se encontro el producto";
		}

		Session::put('idsProductos',$arrIds);
		Session::put('kart',$arrKart);

		$productos = Session::get('kart');
		
		echo json_encode(array_values($productos));
	}

	
}
?>