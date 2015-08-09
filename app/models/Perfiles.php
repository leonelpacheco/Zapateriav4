<?php  
/**
* 
*/
class Perfiles extends Eloquent
{
	
	protected $table = 'perfiles';

	public function perfilAccesos(){
		return $this->belongsToMany('modulos', 'perfilmodulos','perfil_id','modulo_id')->withPivot('lectura', 'escritura');
	}

}

?>

