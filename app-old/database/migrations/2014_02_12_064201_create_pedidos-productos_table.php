<?php

use Illuminate\Database\Migrations\Migration;

class CreatePedidosProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidosproductos', function($table)
		{
		    //$table->engine = 'InnoDB';
		    $table->integer('pedido_id')->nullable()->unsigned();
		    $table->index('pedido_id');
		    $table->integer('producto_id')->nullable()->unsigned();
		    $table->index('producto_id');
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