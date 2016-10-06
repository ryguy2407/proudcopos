<?php
use Carbon\Carbon;

class SalesController extends BaseController {


	protected $stock;
	protected $transactions;

	public function __construct(StockItemInterface $stock, TransactionInterface $transactions)
	{
		$this->stock = $stock;
		$this->transactions = $transactions;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array(
			'cart' => Cart::contents(),
			'transactions' => $this->transactions->get(Session::get('transaction')),
			'sum' => $this->transactions->sum(Session::get('transaction'))
		);
		return View::make('sales.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$search_term = Input::get('stock_search');
		$stock = $this->stock->where($search_term);

		if($stock) {
			foreach($stock as $s) {
				if(!$s->sold) {
					Cart::insert(array(
						'id' => $s->id,
						'name' => $s->stock_description,
						'price' => $s->sale_price,
						'quantity' => 1
					));
					$class = 'success';
					$message = 'Item added';
				} else {
					$class = 'message';
					$message = 'Item already sold';
				}
			}
		} else {
			$class = 'message';
			$message = 'Item doesn\'t exist';
		}
		return Redirect::to('sales')->with($class, $message);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reports()
	{
		//
		$data = $this->transactions->dailyReport(Carbon::today()->startOfDay(), Carbon::today()->endOfDay());
		return View::make('sales.reports')->with($data); 
	}

	public function getReports()
	{
		$input = Input::get('date');
		$data = $this->transactions->dailyReport(Carbon::createFromFormat('Y-m-d', $input)->startOfDay(), Carbon::createFromFormat('Y-m-d', $input)->endOfDay());
		return View::make('sales.reports')->with($data); 
	}

	public function MonthlyReports()
	{
		//
		$data = $this->transactions->dailyReport(Carbon::today()->startOfDay(), Carbon::today()->endOfDay());
		return View::make('sales.monthly')->with($data); 
	}

	public function postMonthlyReports()
	{
		$startdate = Input::get('start_date');
		$enddate = Input::get('end_date');
		$data = $this->transactions->dailyReport(Carbon::createFromFormat('Y-m-d', $startdate)->startOfDay(), Carbon::createFromFormat('Y-m-d', $enddate)->endOfDay());
		return View::make('sales.monthly')->with($data); 
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}

	public function delete($id)
	{
		foreach (Cart::contents() as $item) {
    		if($item->id == $id)
    		{
    			$item->remove();
    		}
		}
		return Redirect::route('sales')->with('message', 'Cart destroyed! Mwa ha ha!');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyAll()
	{
		if(Session::get('transaction')){
			Transaction::destroy(Session::get('transaction'));
		}
		Session::forget('transaction');
		return Redirect::route('sales')->with('message', 'Payments all cleared');
	}

}