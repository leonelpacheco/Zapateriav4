<?php  
/**
* 
*/
class ClientesPDO extends ModelPDO
{
	protected $table = 'clientes';

	public function find($campo,$valor){
		$query = 'select * from clientes where '.$campo.'= :valor';
		$response = $this->select($query, array('valor' => $valor ) );
		return $response;
	}
	
}

?>