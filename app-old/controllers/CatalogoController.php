<?php  
/**
* 
*/
class CatalogoController extends BaseController
{
	private $modelProductos;
	public function __construct(){
		$this->modelProductos = new ProductosPDO; 
	}
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
}
?>