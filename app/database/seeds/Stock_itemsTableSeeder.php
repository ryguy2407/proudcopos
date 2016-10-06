<?php

class Stock_itemsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('stock_items')->truncate();

		$stock_items = array(
			array(
			'stock_number' => '123456',
			'stock_description' => 'Apple Iphone',
			'sent' => '0',
			'listed' => '0',
			'sold' => '0',
			'sale_price' => '100'
			),
			array(
			'stock_number' => '2222222',
			'stock_description' => 'Test Two',
			'sent' => '0',
			'listed' => '0',
			'sold' => '0',
			'sale_price' => '100'
			),
			array(
			'stock_number' => '333333',
			'stock_description' => 'Test Three',
			'sent' => '0',
			'listed' => '0',
			'sold' => '0',
			'sale_price' => '100'
			),
			array(
			'stock_number' => '444444',
			'stock_description' => 'Test Four',
			'sent' => '0',
			'listed' => '0',
			'sold' => '0',
			'sale_price' => '100'
			)
		);

		// Uncomment the below to run the seeder
		DB::table('stock_items')->insert($stock_items);
	}

}
