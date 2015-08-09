<?php

use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidos', function($table)
		{
		    //$table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->dateTime('fecha_pedido');
		    $table->dateTime('fecha_atendido');
		    $table->dateTime('fecha_entregado');
		    $table->integer('estado');
		    $table->integer('usuario_id')->nullable()->unsigned();
		    $table->index('usuario_id');
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