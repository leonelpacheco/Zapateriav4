<?php

use Illuminate\Database\Migrations\Migration;

class CreatePerfilModulosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perfilmodulos', function($table)
		{
		    //$table->engine = 'InnoDB';
		    $table->integer('perfil_id')->nullable()->unsigned();
		    $table->integer('modulo_id')->nullable()->unsigned();
		    $table->timestamps();
		    $table->index('perfil_id');
		    $table->index('modulo_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}