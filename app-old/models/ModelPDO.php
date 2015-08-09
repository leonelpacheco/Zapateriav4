<?php


abstract class ModelPDO
{
    private $_db;
    protected $table;
    
    public function __construct() {
        /*Hay que revisar como obtener las variables de configuracion para la conexion a la bd*/
        $this->_db = new PDO('mysql:host=localhost;dbname=zapateria;charset=utf8', 'root', '');
    }
    /**
    *Funcion que recibe un sql y devuelve un arreglo, solo para selects
    */
    public function select($query,$params = array()){
    	try {
    		$result = $this->_db->prepare($query);
            if(!empty($params)){
                foreach ($params as $key => &$value) {
                    $result ->bindParam(":".$key,$value);
                }
            }
	        $result ->execute();
            $arr = $result->fetchAll(PDO::FETCH_ASSOC);
           
	        return $arr;

	        #return $query;
    	}catch (PDOException $e) {
    		return $e->getMessage();
    	}
    }
    /**
    *Funcion que recibe un sql para editar, modificar o elminar 
    *regresa 0 si todo fue correcto 
    *Create update delete
    */
    public function cud($query){
    	try {
    		$result = $this->_db->prepare($query);
	        $result ->execute();
	        if($result){
				return 0; 
			}else{
				return 1;
			}
    	}catch (PDOException $e) {
    		return $e->getMessage();
    	}
    }
    /**
    *insertar 
    *Funcion que recibe un arreglo asociativo con los paramentros que se insertaran
    *las keys del arreglo son los nombres de la columnas y el valor, es el valor que se insertara
    *regresa 0 si todo ok , cualquier otro valor se considera como error
    */
    public function insert($arr){
    	try{
    		$params = "(";
    		$values = "(";
    		foreach ($arr as $key => $value) {
    			$params .= $key.",";
    			$values .= ":".$key.",";
    		}
    		
    		$params = substr($params,0,-1);
			$values = substr($values,0,-1);
    		$values .= ")";
    		$params .= ")";
			$query = "INSERT INTO " . $this->table . $params . " VALUES " . $values;
			$statement = $this->_db->prepare($query);
			foreach ($arr as $key => &$value) {
				//$param = ":".$key;
				$statement->bindParam(":".$key,$this->getText($value));
			}
			$statement->execute();
			if($result){
				return 0; 
			}else{
				return 1;
			}
		}catch(PDOException $e){
			return $e->getMessage();
		}
    }
    /**
    *insertar 
    *Funcion que recibe un arreglo asociativo con los paramentros que se actualizaran
    *las keys del arreglo son los nombres de la columnas y el valor, es el valor que se actualizara
    *regresa 0 si todo ok , cualquier otro valor se considera como error
    */
    public function update($arr,$valor,$where="id"){
    	try{
    		$params = "";
    		foreach ($arr as $key => $value) {
    			$params .= $key."= :" . $key . ",";
    		}
    		$params = substr($params,0,-1);
    		$params .= " where " . $where . " = :valor";
			$query = "UPDATE " . $this->table . " SET " . $params;

			$statement = $this->_db->prepare($query);
			foreach ($arr as $key => &$value) {
				$statement->bindParam(":".$key,$value);
			}
			$statement->bindParam(':valor',$valor);
			$statement->execute();
			if($statement){
                $resp = 0;
				return $resp; 
			}else{
                $resp = 1;
				return $resp;
			}
		}catch(PDOException $e){
			return $e->getMessage();
		}
    }
    /**
	*Funcion para eliminar
	*recibe el valor que buscara para eliminar
	*y el campo donde buscara el valor
	*regresa 0 ok otro valor es considerado como un error
    */
    public function delete($valor,$where){
    	try{
			$query = "DELETE FROM " . $this->table . " WHERE " . $where . "= :valor";
			$statement = $this->_db->prepare($query);
			
			$statement->bindParam(':valor',$this->getText($valor));
			$statement->execute();
			if($result){
				return 0; 
			}else{
				return 1;
			}
		}catch(PDOException $e){
			return $e->getMessage();
		}
    }
    /**
    *Esta funcion llama a un sp 
    *recibe el nombre del sp y un arreglo con las variables que se le
    *pasaran el 
    */
    public function sp($sp,$params){

        
    }

    private function getText($string)
    {
        if(!empty($string)){
            $string = htmlspecialchars($string, ENT_QUOTES);
            return $string;
        }
        return null;
    }
}

?>