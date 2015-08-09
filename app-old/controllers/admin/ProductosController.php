<?php

class ProductosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		#ValidaAccesoController::validarAcceso('productos','lectura');
		$productos = DB::table('productos')
						->leftJoin('subcategorias','productos.subcategoria_id','=','subcategorias.id')
						->select('productos.id','productos.producto','productos.descripcion','productos.precio_inicial','subcategorias.subcategoria')->get();
		if(is_null($productos) || sizeof($productos) <1 ){
			$productos = null;
		}else{
			$productos = MyHps::toArray( $productos );
		}
		#columnas para desplegar la informacion de la tabla
		$columnas = array('producto'=>'Producto','descripcion'=>'Descripcion','precio_inicial'=>'Precio','subcategoria'=>'Subcategoria');
		$data = array('productos' => $productos, 'columnas' => $columnas );
		return View::make('admin/productosIndex')->with('data', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		ValidaAccesoController::validarAcceso('productos','escritura');
		$categorias = Categorias::all();
		if (!is_null($categorias)) {
			$categorias = $categorias->toArray();
		}
		$subcategorias = Subcategorias:: all();
		if(!is_null($subcategorias)){
			$subcategorias = $subcategorias->toArray();
		}
		$proveedores = Proveedores::all();
		if(!is_null($proveedores)){
			$proveedores = $proveedores->toArray();
		}



		$form_data = array('route' => array('productos.store'), 'method' => 'post','enctype' => 'multipart/form-data');
        $action    = 'Crear';
        $producto = null;
		return View::make('admin/producto',compact('producto','form_data','action','subcategorias','proveedores','categorias'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$campos['producto'] = Input::get('producto');
		$campos['descripcion'] = Input::get('descripcion');
		$campos['marca'] = Input::get('marca');
		$campos['cantidad'] = Input::get('cantidad');
		$campos['precio_inicial'] = Input::get('precio_inicial');
		$campos['img'] = Input::get('img');
		$campos['categoria'] = Input::get('categoria_id');
		$campos['subcategoria'] = Input::get('subcategoria_id');
		$campos['activo'] = Input::get('activo');
		$validacion=Validator::make($campos,
        [
            'producto'=>'required',
            'descripcion'=>'required',
            'marca'=>'required',
            'cantidad'=>'required',
            'precio_inicial'=>'required',
            'img'=>'required',
            'categoria'=>'required',
            'subcategoria'=>'required',
            //'proveedor'=>'required',
            'activo'=>'required'


        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }
		ValidaAccesoController::validarAcceso('productos','escritura');
		$producto = new Productos;
		#extensiones permitidas
		$exts = array('png','jpg','gif');
	  	$file = Input::file('imgFile');
 		$error = "Error al subir el archivo";
 		$bnd = 0;
 		
		$destinationPath  = 'assets/img/productos/';
		$strRandom        = str_random(8);
		$fileName         = $strRandom."_".$file->getClientOriginalName();    
		$_POST['imgName'] = $fileName;
		$extension        = $file->getClientOriginalExtension();
		if(!in_array(strtolower($extension), $exts)){
			$error = "Solo se aceptan los siguientes formatos de imagenes png, jpg, gif";
			$bnd = 1;
		}
		#se valida que la extension sea permitida
		$upload_success = 0;
		if($bnd == 0){
			$upload_success   = Input::file('imgFile')->move($destinationPath, $fileName);
		}
		#se valida que se hay la img se cargo y que la extension sea permitida
		if( $upload_success && $bnd == 0 ) {
			if( $producto->validSave(Input::all()) ){
				return Redirect::route('productos.index');
			}else{
				#eliminamos el archivo si no se guardo correctamente el producto
				File::delete($destinationPath.$fileName);
				return Redirect::route('productos.create')->withInput()->withErrors($producto->errores);
			}
		}else{
			return Redirect::route('productos.create')->withInput()->withErrors(array($error));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		ValidaAccesoController::validarAcceso('productos','escritura');
		$modelProductos = new ProductosPDO;
		$categorias = Categorias::all();
		if (!is_null($categorias)) {
			$categorias = $categorias->toArray();
		}

		$producto = Productos:: find($id);
		if(is_null($producto)){
			return Redirect::route('ErrorIndex','404');
		}
		$subcategorias = Subcategorias:: all();
		if(!is_null($subcategorias)){
			$subcategorias->toArray();
		}
		$proveedores = Proveedores::all();
		if(!is_null($proveedores)){
			$proveedores->toArray();
		}
		$subcategoria = Subcategorias::find($producto->subcategoria_id);
		$categoria = Categorias::find($subcategoria->categoria_id);
		$categoria_id = $categoria->id; 
		$form_data = array('route' => array('productos.update', $producto->id), 'method' => 'PUT','enctype' => 'multipart/form-data');
        $action    = 'Editar';
		return View::make('admin/producto',compact('producto','form_data','action','categorias','subcategorias','proveedores','categoria_id'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$campos['producto'] = Input::get('producto');
		$campos['descripcion'] = Input::get('descripcion');
		$campos['marca'] = Input::get('marca');
		$campos['cantidad'] = Input::get('cantidad');
		$campos['precio_inicial'] = Input::get('precio_inicial');
		$campos['img'] = Input::get('img');
		$campos['categoria'] = Input::get('categoria_id');
		$campos['subcategoria'] = Input::get('subcategoria_id');
		$campos['activo'] = Input::get('activo');
		$validacion=Validator::make($campos,
        [
            'producto'=>'required',
            'descripcion'=>'required',
            'marca'=>'required',
            'cantidad'=>'required',
            'precio_inicial'=>'required',
            'img'=>'required',
            'categoria'=>'required',
            'subcategoria'=>'required',
            //'proveedor'=>'required',
            'activo'=>'required'


        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }
		ValidaAccesoController::validarAcceso('productos','escritura');
		$producto = Productos:: find($id);
		$img = $producto->img;
		#extensiones permitidas
		$exts = array('png','jpg','gif');
	  	$file = Input::file('imgFile');
	  	$destinationPath  = 'assets/img/productos/';
	  	$extension = "";
	  	#bandera para determinar si existe un problema con el formato del archivo
 		$bnd = 0;
 		#esta bandera sirve para determinar si se envio una imagen que replazara a la img actual del producto	
 		$bnd2 = 0;
	  	#comprobar si se esta mandando un archivo
	  	if( $file){
	 		$error = "Error al subir el archivo";
	 		
			$strRandom        = str_random(8);
			$fileName         = $strRandom."_".$file->getClientOriginalName();    
			$_POST['imgName'] = $fileName;
			$extension        = $file->getClientOriginalExtension();
			#validamos que el archivo sea una imagen
			if(!in_array(strtolower($extension), $exts)){
				$error = "Solo se aceptan los siguientes formatos de imagenes png, jpg, gif";
				$bnd = 1;
			}
			$bnd2 = 0;
		}else{
			$_POST['imgName'] = Input::get('img');
			$bnd2 = 1;
		}
		
		#se valida que exista el producto
		//print_r($producto);
		if(is_null($producto)){
			return Redirect::route('ErrorIndex','404');
		}

		
		$upload_success = 0;
		#se valida que la extension sea permitida y que se haya enviado un archivo
		if($bnd == 0 && $file){
			$upload_success = $file->move($destinationPath, $fileName);
			
		}
		#se comprueba que se haya subido el archivo en caso de que se haya mandado
		#si no se mado se comprueba que bnd2 sea uno que indica que no queria sustituir la imagen, solo se modificarian
		#otros parametros del producto
		if( $upload_success || $bnd2 ) {

			if( $producto->validSave( Input::all() ) ){
				File::delete($destinationPath.$img);
				return Redirect::route('productos.index');
			}else{
				//elimanos el archivo si no se guardo correctamente la actualizacion
				if( $file ){
					File::delete($destinationPath.$fileName);
				}
				return Redirect::route('productos.edit',$id)->withInput()->withErrors($producto->errores);
			}
		}else{
			return Redirect::route('productos.edit',$id)->withInput()->withErrors(array($error));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		ValidaAccesoController::validarAcceso('productos','escritura');
		$producto = Productos::find($id);
		if(is_null($producto)){
			echo 'Recurso no encontrado';
			exit;
		}
		$producto->delete();
		echo 1;
	}
	


}