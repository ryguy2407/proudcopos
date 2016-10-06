<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Transactions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cash')->nullable();
			$table->integer('bank_transfer')->nullable();
			$table->integer('eftpos')->nullable();
			$table->integer('paypal')->nullable();
			$table->integer('total');
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
		Schema::drop('transactions');
	}

}
