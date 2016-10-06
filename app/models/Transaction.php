<?php

class Transaction extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function Stock_items()
	{
		return $this->hasMany('Stock_item');
	}
}