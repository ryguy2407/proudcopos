<?php
class SearchController extends BaseController {

	protected $stock;

	public function __construct(StockItemInterface $stock)
	{
		$this->stock = $stock;
	}

	public function index()
	{
		return Redirect::route('stock_items.index')->with('message', 'Please search for stock in the form above');
	}

	public function show()
	{
		$search_term = Input::get('search');
		$stock = $this->stock
			->where($search_term);
		return View::make('stock_items.index', compact('stock'));
	}
}