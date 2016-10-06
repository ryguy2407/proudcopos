<?php

class TransactionsController extends BaseController {

	protected $transaction;

	public function __construct(TransactionInterface $transaction)
	{
		$this->transaction = $transaction;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$transactions = Transaction::with('stock_items')->get();
		return View::make('transactions.index')->with('transactions', $transactions);
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
		//If there is a cart active create a transaction
		$sess = $this->transaction->createFromSession(Session::get('transaction'), Input::all(), Input::get('payment_type'), Input::get('amount'));

		//Get the current transaction session and get the total payments recieved
		$payment = $this->transaction->get($sess);
		$sum = $payment->cash + $payment->eftpos + $payment->bank_transfer + $payment->paypal + $payment->postage_price;

		//If total payments is equal to sale price then tag the tock items with transaction ids and
		//redirect to view and destroy the sessions of the cart and transaction
		$transaction = $this->transaction->complete($sum, $payment);
		if($transaction)
		{
			return Redirect::to('transaction/'.$payment->id)->with('transactions', $payment);
		} else {
			return Redirect::to('sales')->with('transactions', $payment);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$transactions = Transaction::find($id);
		return View::make('transactions.show')->with('transactions', $transactions);
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}