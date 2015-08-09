<?php  
/**
* 
*/
class Proveedores extends Eloquent
{
	protected $table = 'proveedores';

	public $errores;
	public function isValid($data){
		$rules = array(
			'proveedor'   => 'required',
			'descripcion' => 'required|min:4',
			'correo'    => 'required',
			'telefono'     => 'required|numeric',
			'rfc'     => 'required'
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
			$this->proveedor   = $data['proveedor'];
			$this->descripcion = $data['descripcion'];
			$this->correo  	   = $data['correo'];
			$this->telefono    = $data['telefono'];
			$this->rfc 		   = $data['rfc'];
			$this->save();
			return true;
		}
		return false;
	}

		public function validEdit($data){
		if($this->isValid($data))
		{	
				
			$this->proveedor   = $data['proveedor'];
			$this->descripcion = $data['descripcion'];
			$this->correo  	   = $data['correo'];
			$this->telefono    = $data['telefono'];
			$this->rfc 		   = $data['rfc'];
			$this->save();
		}
		return false;
	}
	
}
?>