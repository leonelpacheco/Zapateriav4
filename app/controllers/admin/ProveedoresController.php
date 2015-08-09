<?php

class ProveedoresController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		//ValidaAccesoController::validarAcceso('Proveedores','lectura');
		$proveedores = Proveedores::all();
		if(is_null($proveedores)){
			$proveedores = null;
		}else{
			$proveedores = $proveedores->toArray();
		}

		$columnas = array('proveedor' => 'Proveedor', 'descripcion' => 'Descripción', 'correo'=>'Correo','telefono'=>'Teléfono', 'rfc'=>'RFC');
		$data = array('proveedores' => $proveedores, 'columnas' => $columnas);
		return View::make('admin/proveedoresIndex')->with('data', $data);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//ValidaAccesoController::validarAcceso('Proveedores','escritura');
		$form_data = array('route' => array('proveedores.store'), 'method' => 'post');

        $action    = 'Crear';
        $proveedor= null;
		return View::make('admin/proveedor',compact('proveedor','form_data','action'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{


		$campos['proveedor'] = Input::get('proveedor');
		$campos['descripcion'] = Input::get('descripcion');
		$campos['correo'] = Input::get('correo');
		$campos['telefono'] = Input::get('telefono');
		$campos['rfc'] = Input::get('rfc');
		$validacion=Validator::make($campos,
        [
            'proveedor'=>'required',
            'descripcion'=>'required',
            'correo'=>'required',
            'telefono'=>'required',
            'rfc'=>'required'
        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }
		//ValidaAccesoController::validarAcceso('Proveedores','escritura');
		$proveedor = new proveedores;

		if( $proveedor->validSave(Input::all()) ){
			return Redirect::route('proveedores.index');
		}else{
			return Redirect::route('proveedores.create')->withInput()->withErrors($proveedor->errores);
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
		//ValidaAccesoController::validarAcceso('Proveedores','escritura');
		$proveedor = Proveedores:: find($id);
		if(is_null($proveedor)){
			return Redirect::route('ErrorIndex','404');
		}
		$form_data = array('route' => array('proveedores.update', $proveedor->id), 'method' => 'PUT');#puede ser PATCH
        $action    = 'Editar';
		return View::make('admin/proveedor',compact('proveedor','form_data','action'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	
		$campos['proveedor'] = Input::get('proveedor');
		$campos['descripcion'] = Input::get('descripcion');
		$campos['correo'] = Input::get('correo');
		$campos['telefono'] = Input::get('telefono');
		$campos['rfc'] = Input::get('rfc');
		$validacion=Validator::make($campos,
        [
            'proveedor'=>'required',
            'descripcion'=>'required',
            'correo'=>'required',
            'telefono'=>'required',
            'rfc'=>'required'
        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }
		//ValidaAccesoController::validarAcceso('Proveedores','escritura');
		$proveedor = proveedores:: find($id);

		if(is_null($proveedor)){
			return Redirect::route('ErrorIndex','404');
		}
		
		if( $proveedor->validSave(Input::all()) ){
			return Redirect::route('proveedores.index');
		}else{
			return Redirect::route('proveedores.edit',$id)->withInput()->withErrors($proveedor->errores);
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
		//ValidaAccesoController::validarAcceso('Proveedores','escritura');
		$proveedor = proveedores:: find($id);
		if(is_null($proveedor)){
			echo 'Recurso no encontrado';
		}
		$proveedor->delete();
		echo 1;
	}

}