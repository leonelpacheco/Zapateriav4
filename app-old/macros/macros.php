<?php 
	#macro para crear boton value del boton, nombre e id, enabled y clase css
	Form::macro('mybutton', function($value,$name,$enabled=true,$class=""){
		$disabled = ($enabled) ? "" : "disabled";
		$button = '<input type="button" id="'.$name.'" value="' . $value .'" name="' . $name .'" '. $disabled .' class="' . $class . '">';
		return $button;
	});
	Form::macro('mylabel',function($text,$for="",$class=""){
		$label = '<label for="' . $for . '" class="'.$class.'" >' . $text .'</label>';
		return $label;
	});
	Form::macro('mylink',function($text,$id,$href="#",$class="")
	{
		$link = '<a href="'.$href.'" id="'.$id.'" class="'.$class.'"">'.$text.'</a>'; 
		return $link;
	});

	Form::macro('mypassword',function($id,$class=""){
		$input = '<input id="'.$id.'" name="'.$id.'" type="password" class="'.$class.'">';
		return $input;
	});

	Form::macro('mylistUl',function($arr,$id,$class="")
	{
		$ul = '<ul id="'.$id.' class="'.$class.'">';
		for ($i=0; $i < sizeof($arr) ; $i++) { 
			$ul .= '<li id="'.$id.'_'.$i.'" >'.$arr[$i].'</li>';
		}
		$ul .= '</ul>';
		return $ul;
	});


	/**
	*Esta macro sirve para crear las tablas que listan los recursos,
	*por lo que contendran los botones de ELIMINAR Y EDITAR
	*recibe:
	*	$arr      -> el array que contiene los datos que se pondran en la tabla
	*	$id       -> id de la tabla
	*	$class    -> clases css de la tabla
	*	$columnas -> un array asociativo:
	*									$columna[key] => valor, donde :
	*									key es la clave que referencia el campo del arreglo $arr
	*									valor es el nombre de la columna que se mostrara en la tabla ejemplo:
	*									
	*  |---------------|----------------|
	*  |columnas[valor]|columnas[valor] |
	*  |---------------|----------------|
	*  |arr[key]       |arr[key]        |
	*  |---------------|----------------|
	*	$resource -> nombre del recurso
	*/
	Form::macro('tablaResources',function($arr,$id,$class = "",$columnas,$resource,$opciones = true){
		$tCol = sizeof($columnas);
		$tabla  = '<table id="'.$id.'" class ="'.$class.'">';
		$tabla .= '    <thead>';
		$tabla .= '        <tr>';
		$tabla .= '            <th>No.</th>';
		foreach ($columnas as $key => $columna) {
			$tabla .= '        <th>'.$columna.'</th>'; 
		}
		$tabla .= '			   <th>Opciones</th>'; 
		$tabla .= '        </tr>';
		$tabla .= '    </thead>';
		$tabla .= '    <tbody>';
		#validacion por si es null o no tiene registros
		if(is_null($arr) || sizeof($arr) < 1 ){
			$tabla .= '    <tr>';
			$tabla .= '        <td>Vacio</td>';
			foreach ($columnas as $key => $value) {
				$tabla .= '    <td>Vacio</td>';
			}
			$tabla .= '        <td>Vacio</td>';
			$tabla .= '    </tr>';
		}else{
			for ($i=0; $i < sizeof($arr); $i++) { 
				$tabla .= '    <tr>';
				$tabla .= '            <td>'.($i+1).'</td>';
				foreach ($columnas as $key => $value) {
					$tabla .= '        <td>'.$arr[$i][$key].'</td>';
				}
				$tabla .=($opciones)? '<td><a href="'.route($resource.'.index').'/'.$arr[$i]['id'].'/edit" class="icon-pencil"></a>':'';
				$tabla .=($opciones)? '<a href="'.route($resource.'.index').'/'.$arr[$i]['id'].'" class="icon-close"></a></td>':'';
				$tabla .= '    </tr>';
			}
		}
			
		$tabla .= '    </tbody>';
		$tabla .= '</table>';
		return $tabla;
	});
	/**
	*Macro que cre un select
	*recibe;
	*  $arr el arreglo de valores,
	*  $selected valor que se seleccionara
	*  $idSelect name e id del elemento
	*  $val columana de donde obtendra el texto que pondra en el select
	*  $col columna donde buscara el valor a seleccionar  por defecto id
	*/
	Form::macro('myselect',function($arr,$selected,$idSelect,$val,$col='id',$class='form-control'){
		$select = '<select class="'.$class.'" id="'.$idSelect.'" name="'.$idSelect.'">';
		$select .= '    <option value="" > </option>';
		if(!is_null($arr) || !empty($arr)){
			foreach ($arr as $key => $value) {
				$selecconar = ($value[$col] == $selected) ? 'selected' : '';
				$select .= '<option value="'.$value[$col].'" '.$selecconar.' >'.$value[$val].'</option>';
				$selecconar = '';
			}
		}
		$select .= '</select>';
		return $select;
	});
	/**
	*Esta macro sirve para crear las tablas que listan los pedidos,
	*por lo que contendra solo el boton ver
	*recibe:
	*	$arr      -> el array que contiene los datos que se pondran en la tabla
	*	$id       -> id de la tabla
	*	$class    -> clases css de la tabla
	*	$columnas -> un array asociativo:
	*									$columna[key] => valor, donde :
	*									key es la clave que referencia el campo del arreglo $arr
	*									valor es el nombre de la columna que se mostrara en la tabla ejemplo:
	*									
	*  |---------------|----------------|
	*  |columnas[valor]|columnas[valor] |
	*  |---------------|----------------|
	*  |arr[key]       |arr[key]        |
	*  |---------------|----------------|
	*	$resource -> nombre del recurso
	*/
	Form::macro('tablaPedidos',function($arr,$id,$class="",$columnas,$resource){
		$tCol = sizeof($columnas);
		$tabla  = '<table id="'.$id.'" class ="'.$class.'">';
		$tabla .= '    <thead>';
		$tabla .= '        <tr>';
		$tabla .= '            <th>No.</th>';
		foreach ($columnas as $key => $columna) {
			$tabla .= '        <th>'.$columna.'</th>'; 
		}
		$tabla .= '			   <th>Opciones</th>'; 
		$tabla .= '        </tr>';
		$tabla .= '    </thead>';
		$tabla .= '    <tbody>';
		#validacion por si es null o no tiene registros
		if(is_null($arr) || sizeof($arr) < 1 ){
			$tabla .= '    <tr>';
			$tabla .= '        <td>Vacio</td>';
			foreach ($columnas as $key => $value) {
				$tabla .= '    <td>Vacio</td>';
			}
			$tabla .= '        <td>Vacio</td>';
			$tabla .= '    </tr>';
		}else{
			for ($i=0; $i < sizeof($arr); $i++) { 
				$tabla .= '    <tr>';
				$tabla .= '            <td>'.($i+1).'</td>';
				foreach ($columnas as $key => $value) {
					$tabla .= '        <td>'.$arr[$i][$key].'</td>';
				}
				$tabla .= '				<td><a href="'.route($resource.'.index').'/'.$arr[$i]['id'].'" class="icon-search"></a></td>';
				$tabla .= '    </tr>';
			}
		}
			
		$tabla .= '    </tbody>';
		$tabla .= '</table>';
		return $tabla;
	});
/**
 * Lista los productos comprados al mandar el email
 */
Form::macro('tablaProductosEmail',function($arr){
		$tabla  = '<table class ="tablexxx tablexxx-bordered">';
		$tabla .= '    <thead>';
		$tabla .= '        <tr>';
		$tabla .= '           <th>No.</th>';
		$tabla .= '        		<th>Producto</th>'; 
		$tabla .= '        		<th>Cantidad</th>'; 
		$tabla .= '			   		<th>Precio</th>'; 
		$tabla .= '        </tr>';
		$tabla .= '    </thead>';
		$tabla .= '    <tbody class="tbodyproductos">';
		$total = 0;
		for ($i=0; $i < sizeof($arr); $i++) { 
			$total += $arr[$i]['precio'];
			$tabla .= '  <tr>';
			$tabla .= '    <td>'.($i+1).'</td>';
			$tabla .= '    <td>'.$arr[$i]['producto'].'</td>';
			$tabla .= '    <td>'.number_format($arr[$i]['cantidad'], 0, '.', ',').'</td>';
			$tabla .= '    <td>'.number_format($arr[$i]['precio'], 2, '.', ',').'</td>';
			$tabla .= '  </tr>';
		}
		$tabla .= '  <tr>';
		$tabla .= '    <td colspan="2" style="text-align:right;border:none;"></td>';
		$tabla .= '    <td colspan="2" style="text-align:right; color:#000;border:none;"><strong>Total = '.number_format($total, 2, '.', ',').'</strong></td>';
		$tabla .= '  </tr>';
		$tabla .= '    </tbody>';
		$tabla .= '</table>';
		return $tabla;
	});
?>