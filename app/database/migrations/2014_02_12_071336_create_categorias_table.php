<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorias', function($table)
		{
		    //$table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->string('categoria');
		    $table->string('descripcion');
		    $table->integer('posicion')->unique();
		    $table->integer('mostrar');
		    $table->timestamps();
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