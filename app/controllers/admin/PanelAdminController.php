<?php  
/**
* 
*/
class PanelAdminController extends BaseController
{
	public function index()
	{
		//ValidaAccesoController::validarAcceso('panelAdmin','lectura');
		$modelPedidos = new PedidosPDO;
		/* mostrar informacion relevanye como pedidos, ventas ultimo mes,semana o cosas asi*/
		$data = array('categorias', 'subcategorias', 'productos', 'usuarios','pedidos','pagos');
		$pedidos = $modelPedidos->select("SELECT p.*, c.apellidos, c.email FROM pedidos p
										 INNER JOIN clientes c ON c.id= p.cliente_id or isnull(p.cliente_id)
										 WHERE p.estado = 0 order by fecha_pedido");
		$pedidos = MyHps::estadoPedido($pedidos,'estado');
		#columnas de la tabla 
		$col = array("apellidos" => 'Apellidos', "email" => "Correo", "fecha_pedido" => "Fecha");
		return View::make('admin/panelAdmin',compact('pedidos','data','col'));#->with('data', $data);
		//echo "holas";
	}

}
?>