<?php

class StockItemRepository implements StockItemInterface {

	public function getAll()
	{
		$stock = Stock_item::orderBy('created_at', 'desc')->paginate(50);
		return $stock;
	}

	public function find($id)
	{
		$stock = Stock_item::find($id);
		return $stock;
	}

	public function store($data)
	{
		Stock_item::create($data);
	}

	public function update($data)
	{
		if (Input::hasFile('image'))
		{
    		$data['image'] = Input::file('image')->getRealPath();	
		}
		Stock_item::update($data);
	}

	public function where($variable)
	{
		$stock = DB::table('stock_items')
			->where('stock_number', 'LIKE', "%$variable%")
			->orWhere('stock_description', 'LIKE', "%$variable%")
			->paginate(10);
		return $stock;
	}

	public function findWhere($query)
	{
		$stock = DB::table('stock_items')->where('sold', '=', '0')->whereNotIn('id', $query)->get();
		return $stock;
	}

	public function findStatus($status)
	{
		$stock = DB::table('stock_items')
			->where('account', '=', $status)->orderBy('created_at', 'desc')->paginate(50);
		return $stock;
	}

}