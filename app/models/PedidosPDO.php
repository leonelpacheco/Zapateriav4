<?php  
/**
* 
*/
class PedidosPDO extends ModelPDO
{
	protected $table = 'pedidos';

	public function getPedidos(){
		//echo "getPedidos";
		$pedidos = $this->select("SELECT * FROM pedidos");
		#return $pedidos."holas";
		return $pedidos;
	}
}
?>