<?php  
/**
* 
*/
class Categorias extends Eloquent
{
	protected $table = 'categorias';
	
	public $errores;
	public function isValid($data){
		$rules = array(
			'categoria'   => 'required',
			'descripcion' => 'required|min:4',
			'posicion'    => 'required|integer',
			'mostrar'     => 'required|integer'
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
			$this->categoria   = $data['categoria'];
			$this->descripcion = $data['descripcion'];
			$this->posicion    = $data['posicion'];
			$this->mostrar     = $data['mostrar'];
			$this->save();
			return true;
		}
		return false;
	}
}
?>