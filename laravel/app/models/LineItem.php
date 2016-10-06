<?php

class LineItem extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function Stocktake()
	{
		return $this->belongsTo('Stocktake');
	}

	public function Stock_item()
	{
		return $this->belongsTo('Stock_item');
	}

}