<?php

class VentasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		#ValidaAccesoController::validarAcceso('productos','lectura');
		/*
		$productos = DB::table('productos')
						->leftJoin('subcategorias','productos.subcategoria_id','=','subcategorias.id')
						->select('productos.id','productos.producto','productos.descripcion','productos.precio_inicial','subcategorias.subcategoria')->get();
		if(is_null($productos) || sizeof($productos) <1 ){
			$productos = null;
		}else{
			$productos = MyHps::toArray( $productos );
		}

		*/
				
				$productos = DB::table('pedidosproductos')	
				//SELECT sum(`num_productos`*`precio`) FROM `pedidosproductos` 					
						->select(DB::raw('sum(num_productos*precio) as total'))

						//->sum('pedidosproductos.num_productos');
						//->sum('pedidosproductos.num_productos');
						 ->take(10)
						
						//echo $productos;
						//->groupBy('productos.id')
						->get();



$mes = date("m");

										$productos3 = DB::table('pedidos')	
				//SELECT sum(`num_productos`*`precio`) FROM `pedidosproductos` 					
						->select(DB::raw('sum(id) as total'))
						->whereRaw('MONTH(fecha_pedido) = ?', [07])
						//->sum('pedidosproductos.num_productos');
						//->sum('pedidosproductos.num_productos');
						
						
						//echo $productos;
						//->groupBy('productos.id')
						->get();





$productos2 = $productos;
$productos4 = $productos3;



		if(is_null($productos) || sizeof($productos) <1 ){
			$productos = null;
		}else{
			$productos = MyHps::toArray( $productos );
		}
		#columnas para desplegar la informacion de la tabla
		$columnas = array('total'=>'TOTAL VENDIDO');
		$data = array('productos' => $productos, 'columnas' => $columnas );



		return View::make('admin/ventaIndex')->with('productos', $productos2)->with('productos2', $productos4);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */


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
           // 'marca'=>'required',
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
		//ValidaAccesoController::validarAcceso('productos','escritura');
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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	


}