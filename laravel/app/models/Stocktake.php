<?php

class Stocktake extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function stock_items()
    {
        return $this->belongsToMany('Stock_item', 'line_items');
    }

}