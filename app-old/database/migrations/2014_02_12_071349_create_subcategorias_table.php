<?php

use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcategorias', function($table)
		{
		    //$table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->string('subcategoria');
		    $table->string('descripcion');
		    $table->integer('posicion')->unique();
		    $table->integer('mostrar');
		    $table->integer('categoria_id')->nullable()->unsigned();
		    $table->index('categoria_id');
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