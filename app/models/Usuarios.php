<?php  
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;



class Usuarios extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public $errores;

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function isValid($data){
		$rules = array(
			'nombres'   => 'required',
			'apellidos' => 'required',
			'email'     => 'required|email|unique:usuarios',
			'telefono'  => 'required|numeric',
			'password'  => 'min:6|confirmed',
			'perfil'    => 'integer'
		);
		if($this->exists){
			$rules['email'] .= ',email,'.$this->id;
		}else{
            // La clave es obligatoria:
            $rules['password'] .= '|required';
            $rules['perfil']   .= '|required';
        }
		$validator = Validator::make($data,$rules);
		if($validator->fails()){
			$this->errores = $validator->errors();
			return false;
		}
		return true;
	}
	public function validSave($data){
		if($this->isValid($data))
		{	
			$this->nombres   = $data['nombres'];
			$this->apellidos = $data['apellidos'];
			$this->email     = $data['email'];
			$this->telefono  = $data['telefono'];
			$this->password  = Hash::make($data['password']);
			$this->perfil_id    = $data['perfil'];
			$this->save();
			return true;
		}
		return false;
	}
	public function validEdit($data){
		if($this->isValid($data))
		{	
			$this->nombres   = $data['nombres'];
			$this->apellidos = $data['apellidos'];
			$this->email     = $data['email'];
			$this->telefono  = $data['telefono'];
			$this->save();
			return true;
		}
		return false;
	}



public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
}

public function getRememberTokenName()
{
    return 'remember_token';
}

}
?>