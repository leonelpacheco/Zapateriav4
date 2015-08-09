<?php

use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedores', function($table)
		{
		    //$table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->string('preoveedor');
		    $table->string('descripcion');
		    $table->string('correo');
		    $table->string('telefono');
		    $table->string('rfc');
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