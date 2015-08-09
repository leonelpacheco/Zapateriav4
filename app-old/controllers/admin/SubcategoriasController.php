<?php

class SubcategoriasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		ValidaAccesoController::validarAcceso('subcategorias','lectura');
		$subcategorias = DB::table('subcategorias')
						->join('categorias','categorias.id','=','subcategorias.categoria_id')
						->select('subcategorias.id','subcategorias.subcategoria','subcategorias.descripcion','categorias.categoria')->get();
		if(is_null($subcategorias) || sizeof($subcategorias) <1 ){
			$subcategorias = null;
		}else{
			$subcategorias = MyHps::toArray( $subcategorias );
		}
		#print_r($subcategorias);
		#exit;
		$columnas = array( 'subcategoria' => 'Subcategoria', 'categoria' => 'Categoria' );
		$data = array('subcategorias' => $subcategorias, 'columnas' => $columnas );
		return View::make('admin/subcategoriasIndex')->with('data', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		ValidaAccesoController::validarAcceso('subcategorias','escritura');
		
		$categorias = Categorias::all();
		if(!is_null($categorias)){
			$categorias = $categorias->toArray();
		}
		$form_data = array('route' => array('subcategorias.store'), 'method' => 'post');
        $action    = 'Crear';
        $subcategoria = null;

		return View::make('admin/subcategoria',compact('subcategoria','form_data','action','categorias'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$campos['subcategoria'] = Input::get('subcategoria');
        $campos['descripcion']  = Input::get('descripcion');
        $campos['posicion']     = Input::get('posicion');
        $campos['categoria']    = Input::get('categoria_id');
        $campos['mostrar']      = Input::get('mostrar');
		$validacion=Validator::make($campos,
        [
            'subcategoria'=>'required',
            'descripcion'=>'required',
            'posicion'=>'required',
            'categoria'=>'required',
            'mostrar'=>'required'
          

        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }
		ValidaAccesoController::validarAcceso('subcategorias','escritura');
		$subcategoria = new Subcategorias;

		if( $subcategoria->validSave(Input::all()) ){
			return Redirect::route('subcategorias.index');
		}else{
			return Redirect::route('subcategorias.create')->withInput()->withErrors($subcategoria->errores);
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
		ValidaAccesoController::validarAcceso('subcategorias','escritura');
		$categorias = Categorias::all();
		if(!is_null($categorias)){
			$categorias = $categorias->toArray();
		}
		
        $subcategoria = Subcategorias::find($id);
        if(is_null($subcategoria)){
			return Redirect::route('ErrorIndex','404');
		}
		$form_data = array('route' => array('subcategorias.update',$subcategoria->id), 'method' => 'PUT');
        $action    = 'Editar';
		return View::make('admin/subcategoria',compact('subcategoria','form_data','action','categorias'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$campos['subcategoria'] = Input::get('subcategoria');
        $campos['descripcion']  = Input::get('descripcion');
        $campos['posicion']     = Input::get('posicion');
        $campos['categoria']    = Input::get('categoria_id');
        $campos['mostrar']      = Input::get('mostrar');
		$validacion=Validator::make($campos,
        [
            'subcategoria'=>'required',
            'descripcion'=>'required',
            'posicion'=>'required',
            'categoria'=>'required',
            'mostrar'=>'required'
          

        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }
		ValidaAccesoController::validarAcceso('subcategorias','escritura');
		$subcategoria =  Subcategorias::find($id);

		if(is_null($subcategoria)){
			return Redirect::route('ErrorIndex','404');
		}

		if( $subcategoria->validSave(Input::all()) ){
			return Redirect::route('subcategorias.index');
		}else{
			return Redirect::route('subcategorias.create')->withInput()->withErrors($subcategoria->errores);
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
		ValidaAccesoController::validarAcceso('subcategorias','escritura');
		$subcategoria = Subcategorias:: find($id);
		if(is_null($subcategoria)){
			echo 'Recurso no encontrado';
		}
		$subcategoria->delete();
		echo 1;
	}

}