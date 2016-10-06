<?php

class Stock_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'barcode' => 'required'
	);

}