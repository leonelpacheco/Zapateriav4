<?php

class UsuariosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		ValidaAccesoController::validarAcceso('usuarios','lectura');
		$usuarios = Usuarios::all();
		
		if(is_null($usuarios)){
			$usuarios = null;
		}else{
			$usuarios = $usuarios->toArray();
		}
		
		$columnas = array('nombres' => 'Nombre(s)', 'apellidos' => 'Apellidos', 'email' => 'Correo' );
		$data = array('usuarios' => $usuarios, 'columnas' => $columnas );
		return View::make('admin/usuariosIndex')->with('data', $data);
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		ValidaAccesoController::validarAcceso('usuarios','escritura');
		$form_data = array('route' => array('usuarios.store'), 'method' => 'post');
        $action    = 'Crear';
        $usuario = null;
		return View::make('admin/usuario',compact('usuario','form_data','action'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$campos['nombres'] = Input::get('nombres');
        $campos['apellidos']  = Input::get('apellidos');
        $campos['email']     = Input::get('email');
        $campos['telefono']    = Input::get('telefono');
        $campos['password']      = Input::get('password');
        $campos['password_confirmation']      = Input::get('password_confirmation');

		$validacion=Validator::make($campos,
        [
            'nombres'=>'required',
            'apellidos'=>'required',
            'email'=>'required',
            'telefono'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required'
          

        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }

		ValidaAccesoController::validarAcceso('usuarios','escritura');
		$usuario = new Usuarios;
		$_POST['perfil'] = null;
		$perfil = Perfiles::where('perfil','=','administrador')->get();
		if(is_null($perfil)){
			return Redirect::route('ErrorIndex','default');
		}
		$perfil = $perfil->toArray();
		
		$inputs = Input::all();
		#se guarda el perfil del administrador
		$inputs['perfil'] = $perfil[0]['id'];
	
		if( $usuario->validSave($inputs)){
			return Redirect::route('usuarios.index');
		}else{
			return Redirect::route('usuarios.create')->withInput()->withErrors($usuario->errores);
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
		ValidaAccesoController::validarAcceso('usuarios','escritura');
		$usuario = Usuarios::find($id);
		if(is_null($usuario)){
			return Redirect::route('ErrorIndex','404');
		}
		$form_data = array('route' => array('usuarios.update',$id), 'method' => 'PUT');
        $action    = 'Editar';
		return View::make('admin/usuario',compact('usuario','form_data','action'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$campos['nombres'] = Input::get('nombres');
        $campos['apellidos']  = Input::get('apellidos');
        $campos['email']     = Input::get('email');
        $campos['telefono']    = Input::get('telefono');
        $campos['password']      = Input::get('password');
        $campos['password_confirmation']      = Input::get('password_confirmation');

		$validacion=Validator::make($campos,
        [
            'nombres'=>'required',
            'apellidos'=>'required',
            'email'=>'required',
            'telefono'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required'
          

        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }

		ValidaAccesoController::validarAcceso('usuarios','escritura');

		$usuario = Usuarios:: find($id);
		
		if(is_null($usuario)){
			return Redirect::route('ErrorIndex','404');
		}
		
		if( $usuario->validEdit(Input::all())){
			return Redirect::route('usuarios.index');
		}else{
			return Redirect::route('usuarios.edit',$id)->withInput()->withErrors($usuario->errores);
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
		ValidaAccesoController::validarAcceso('usuarios','escritura');
		$usuario = Usuarios:: find($id);
		if(is_null($usuario)){
			echo 'Recurso no encontrado';
		}
		$usuario->delete();
		echo 1;
	}

}