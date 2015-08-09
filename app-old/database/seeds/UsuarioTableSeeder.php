<?php 
/**
* 
*/
class UsuarioTableSeeder extends Seeder
{
	
	 public function run()
    {
        $users = [
            ['nombres' => 'luis david', 'apellidos' => 'calva cauich', 'email' => 'david@email.com','telefono' => '9831054382' ,'password' => Hash::make('123456'),'perfil_id' => null]
            //['nombres' => 'gualberto', 'apellidos' => 'quijada raigoza', 'email' => 'beto@email.com','telefono' => '9831238745' ,'password' =>Hash::make('123456'),'perfil_id' => null]
        ];
 
        DB::table('usuarios')->insert($users);
    }
}

?>