<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function($table)
		{
		    //$table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->string('nombres');
		    $table->string('apellidos');
		    $table->string('email')->unique();
		    $table->string('telefono');
		    $table->string('password');
		    $table->integer('perfil_id')->nullable()->unsigned();
		    $table->timestamps();
		    $table->index('perfil_id');
		    /*$table->foreign('perfil_id')->references('id')->on('perfiles')->on_delete('cascade');
 
			$table->foreign('perfil_id')->references('id')->on('perfiles')->on_update('cascade');*/
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios');
	}

}