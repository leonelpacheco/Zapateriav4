<?php 
/**
* 
*/
class Subcategorias extends Eloquent
{
	
	protected $table = 'subcategorias';
	public $errores;
	public function isValid($data){
		$rules = array(
			'subcategoria'   => 'required',
			'descripcion'    => 'required|min:4',
			'posicion'       => 'required|integer',
			'mostrar'        => 'required|integer',
			'categoria_id'   => 'required|integer'
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
			$this->subcategoria = $data['subcategoria'];
			$this->descripcion  = $data['descripcion'];
			$this->posicion     = $data['posicion'];
			$this->mostrar      = $data['mostrar'];
			$this->categoria_id = $data['categoria_id'];
			$this->save();
			return true;
		}
		return false;
	}
}

?>