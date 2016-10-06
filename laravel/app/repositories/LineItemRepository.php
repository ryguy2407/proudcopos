<?php

class LineItemRepository implements LineItemInterface {

	public function getAll()
	{
		$lineitem = LineItem::where('stocktake_id', '=', NULL)->with('Stock_item')->get();
		return $lineitem;
	}

	public function find($id)
	{
		$lineitem = LineItem::where('stocktake_id', '=', $id)->with('Stock_item')->get();
		return $lineitem;
	}

	public function create_where($id, $stockid) 
	{
		$lineitem = LineItem::create(array('stock_item_id' => $stockid, 'stocktake_id' => $id));
		return $lineitem;
	}

	public function create($stockid)
	{
		LineItem::create(array('stock_item_id' => $stockid));
	}

}