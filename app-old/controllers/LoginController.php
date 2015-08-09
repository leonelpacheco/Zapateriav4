<?php  
/**
* 
*/

class LoginController extends BaseController {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   
    public function index(){
        if (Auth::check())
        {
          
            return Redirect::to('admin/panelAdmin');
        }
        return View::make('admin/login');
    }
    public function doLogin(){
        // Guardamos en un arreglo los datos del usuario.
         $validacion=Validator::make(Input::all(),
        [
            'email'=>'required',
            'password'=>'required'
        ]);
        if($validacion->fails()){

            return Redirect::back()->withInput()->withErrors($validacion);
        }
        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
       

        if(Auth::attempt($userdata, Input::get('remember-me', 0)))
        {
             
            
           // De ser datos válidos creamos arreglo de sesion con los accesos a los modulos
            $usuario = Usuarios::where('email','=',$userdata['email'])->first();
            
            #validamos que el usuario exista 
            if ( is_null ($usuario) )
            {
                #echo "Usted no tiene permisos: usuario no encontrado";
                #exit;
                return Redirect::route('loginIndex')->with('mensaje_error', 'Usted no tiene permisos: 1');
            }
            if( is_null($usuario->perfil_id) ){
                #echo 'No tiene perfil';
                #exit;
                return Redirect::route('loginIndex')->with('mensaje_error', 'Usted no tiene permisos: 2');
            }
            $nombreUsuario = $usuario->nombres;
            $idUsuario     = $usuario->id;
            $idPerfilUser  = $usuario->perfil_id;
             #valdiamos que tenga perfil
            $modelPerfilModulos = new PerfilModulosPDO;
            $modulos = $modelPerfilModulos->getModulos($idPerfilUser);
            if( ! $modulos ){
                return Redirect::route('loginIndex')->with('mensaje_error', 'Usted no tiene permisos: 3');
            }
            
            
            foreach ($modulos as $modulo) {
                $arrModulos[$modulo['mAlias']] = array('lectura'   => $modulo['lectura'],
                                                      'escritura' => $modulo['escritura']
                                                      ); 
            } 
            Session::put('modulosAcceso', $arrModulos);
            Session::put('tiempoInicio', time());
            Session::put('datosUsuario',array('idUsuario' => $idUsuario,'nombre' => $nombreUsuario, 'perfil' => strtolower($modulos[0]['perfil']) ) );
         
            
            return Redirect::route('panelAdmin');
        }
        else{
            #return Redirect::to('login')
            #        ->with('mensaje_error', 'Tus datos son incorrectos')
            #        ->withInput();
            #echo "no login";
            #exit;
            return Redirect::route('loginIndex')->with('mensaje_error', 'Datos  incorrectos');
            #echo "datos incorrectos";
        }

        // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
       
    }

    public function doLogout(){
        Session::flush();

    }

}
?>