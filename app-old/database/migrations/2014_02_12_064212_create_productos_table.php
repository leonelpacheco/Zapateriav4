<?php

use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productos', function($table)
		{
		    //$table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->string('producto');
		    $table->string('descripcion');
		    $table->string('marca');
		    $table->string('img');

		    $table->string('precio_inicial');
		    $table->string('precio_final');

		    $table->integer('cantidad');
		    $table->integer('activo');
		    $table->boolean('eliminado');

		    $table->integer('subcategoria_id')->nullable()->unsigned();
		    $table->index('subcategoria_id');

		    $table->integer('proveedor_id')->nullable()->unsigned();
		    $table->index('proveedor_id');

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