<?php  
/**
* 
*/
class PerfilModulosPDO extends ModelPDO
{
	
	public function getModulos($idPerfil){
		$query = 'select pm.*, m.modulo, m.Alias, p.perfil from perfilmodulos pm  
				  inner join modulos m on  pm.modulo_id = m.id
				  inner join perfiles p on pm.perfil_id = p.id
				  where pm.perfil_id= :perfil_id';
		$modulos = $this->select($query, array('perfil_id' => $idPerfil) );
		return $modulos;
	}
	// m.Alias,
}
?>