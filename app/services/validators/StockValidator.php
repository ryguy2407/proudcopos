<?php namespace Services\Validators;

class StockValidator extends Validator {
	public static $rules = array(
		'stock_number' => 'required|unique:stock_items,stock_number',
		'stock_description' => 'required',
		'sale_price' => 'required|numeric'	
	);
}