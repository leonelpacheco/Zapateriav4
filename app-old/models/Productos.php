<?php 
/**
* 
*/
class Productos extends Eloquent
{
	
	protected $table = 'productos';
	public $errores;
	public function isValid($data){
		$rules = array(
			'producto'        => 'required',
			'descripcion'     => 'required|min:4',
			'marca'           => 'required',
			'img'             => 'required',
			'precion_inicial' => 'required|numeric',
			'precion_inicial' => 'numeric',
			'cantidad'        => 'required|integer',
			'activo'          => 'required|integer',
			'eliminado'       => 'integer',
			'subcategoria_id' => 'integer',
			'porveedor_id'    => 'integer'
		);
		$validator = Validator::make($data,$rules);
		if($validator->fails()){
			$this->errores = $validator->errors();
			return false;
		}
		return true;
	}
	public function validSave($data){	
		if($this->isValid($data))
		{
			$this->producto        = $data['producto'];
			$this->descripcion     = $data['descripcion'];
			$this->marca           = $data['marca'];
			$this->img             = $_POST['imgName'];
			$this->precio_inicial  = $data['precio_inicial'];
			#$this->precion_inicial = $data[''];
			$this->cantidad        = $data['cantidad'];
			$this->activo          = $data['activo'];
			#$this->eliminado = $data[''];
			$this->subcategoria_id = $data['subcategoria_id'];
			$this->proveedor_id    = $data['proveedor_id'];
			$this->save();
			return true;
		}
		return false;
	}
}

?>