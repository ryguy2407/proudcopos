<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('stock_number');
			$table->text('stock_description');
			$table->boolean('sent');
			$table->boolean('listed');
			$table->boolean('sold');
			$table->string('image')->nullable();
			$table->integer('sale_price');
			$table->integer('transaction_id')->nullable();
			$table->string('account')->nullable();
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
		Schema::drop('stock_items');
	}

}
