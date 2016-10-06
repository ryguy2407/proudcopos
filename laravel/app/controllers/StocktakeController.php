<?php
use Carbon\Carbon;

class StocktakeController extends BaseController {

	protected $stock;
	protected $lineitem;
	protected $stocktake;

	public function __construct(StockItemInterface $stock, LineItemInterface $lineitem, StocktakeInterface $stocktake)
	{
		$this->stock = $stock;
		$this->lineitem = $lineitem;
		$this->stocktake = $stocktake;
	}

	public function index()
	{
		$lineitems = $this->lineitem->getAll();
		$data = array(
			'lineitems' => $lineitems
		);
		return View::make('stocktake.index')->with($data);
	}

	public function edit($id)
	{
		$lineitems = $this->lineitem->find($id);
		$data = array(
			'lineitems' => $lineitems
		);
		return View::make('stocktake.edit')->with($data);
	}

	public function stocktake_update($id)
	{
		$input = Input::get('stock_search');
		if(!$input)
		{
			return Redirect::route('stocktake.index')->with('message', 'Please enter a vaild stock number or barcode');
		}
		$stock = $this->stock->where($input);

		$this->lineitem->create_where($id, $stock[0]->id);
		return Redirect::route('stocktake.edit', array($id));
	}

	public function store()
	{
		$input = Input::get('stock_search');
		if(!$input)
		{
			return Redirect::route('stocktake.index')->with('message', 'Please enter a vaild stock number or barcode');
		}
		$stock = $this->stock->where($input);

		$this->lineitem->create($stock[0]->id);
		return Redirect::route('stocktake.index');
	}

	public function create()
	{
		$lineitems = $this->lineitem->getAll();
		if(empty($lineitems[0])) {
			return Redirect::route('stocktake.index')->with('message', 'Scan some items fool!');
		}
		$report = $this->stocktake->create($lineitems);
		return Redirect::route('stocktake.report', array($report));
	}

	public function update($id)
	{
		$lineitems = $this->lineitem->find($id);
		if(empty($lineitems[0])) {
			return Redirect::route('stocktake.index')->with('message', 'Scan some items fool!');
		}
		$report = $this->stocktake->update($id, $lineitems);
		return Redirect::route('stocktake.report', array($report));
	}

	public function allReports()
	{
		$reports = $this->stocktake->getAll();
		$data = array('reports' => $reports);
		return View::make('stocktake.showReports')->with($data);
	}

	public function report($id)
	{
		$report = $this->stocktake->find($id);
		$ids = array();
		foreach($report->stock_items()->get() as $r){
			$ids[] = $r->id;
		}
		$stock = $this->stock->findWhere($ids);
		$data = array(
			'report' => $report,
			'not_found' => $stock
		);
		return View::make('stocktake.report')->with($data);
		// foreach($report as $r) {
		// 	echo $r->id;
		// 	    $stock = array();
		// 	    foreach($r->stock_items as $s){
		// 	 	echo $s->id;
		// 	 	$stock[] = $this->stock->findWhere($s->id);
		// 	 }
		// }
		//var_dump($stock);
		// $not_found = $this->stock->findWhere('id', '!=', $report->stock_items()->first()->id);
		// $data = array(
		// 	'report' => $report,
		// 	//'not_found' => $not_found
		// );
		// return View::make('stocktake.report')->with($data);
	}

}