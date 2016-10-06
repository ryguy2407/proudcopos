<?php

class StocktakeRepository implements StocktakeInterface {

	public function getAll()
	{
		$stocktakes = Stocktake::all();
		return $stocktakes;
	}

	public function create($lineitems)
	{
		$stocktake = Stocktake::create(array());
		foreach($lineitems as $lineitem) {

			$item = LineItem::find($lineitem->id);
			$item->stocktake_id = $stocktake->id;
			$item->save();
			// $stocktake->stocktake_id = $stocktake->id;
			// $stocktake->save();
		}
		return $stocktake->id;
	}

	public function update($id, $lineitems)
	{
		$stocktake = Stocktake::find($id);
		foreach($lineitems as $lineitem) {

			$item = LineItem::find($lineitem->id);
			$item->stocktake_id = $stocktake->id;
			$item->save();
			// $stocktake->stocktake_id = $stocktake->id;
			// $stocktake->save();
		}
		return $stocktake->id;
	}

	public function find($id)
	{
		$report = Stocktake::find($id);
		return $report;
	}

}