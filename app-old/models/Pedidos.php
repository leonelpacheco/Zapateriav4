<?php  
/**
* 
*/
class Pedidos extends Eloquent
{
	
	protected $table = 'pedidos';

	public function byUsuario()
	{
		
		return $this->hasOne('usuarios', 'id');
		
	}
	
}
?>