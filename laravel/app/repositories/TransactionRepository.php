<?php

use Carbon\Carbon;

class TransactionRepository implements TransactionInterface {

    public function getAll()
    {
    	$transactions = Transaction::all();
		return $transactions;
    }

    public function get($id)
    {
    	$transactions = Transaction::find($id);
		return $transactions;
    }

    public function createFromSession($sessionid, $payment_type, $amount)
    {
    	if(!$sessionid) {
			$trans = Transaction::create(array(
				Input::get('payment_type') => Input::get('amount'),
				'total' => Cart::total()
				));
			Session::put('transaction', $trans->id);
			$sess = Session::get('transaction');
			return $sess;
		} else {
			$sess = Session::get('transaction');
			$trans = Transaction::where('id', $sess)->update(array(
				Input::get('payment_type') => Input::get('amount')
				));
			}
		return $sess;
    }

    public function complete($sum, $payment)
    {
    	if($sum >= $payment->total){
			foreach(Cart::contents() as $c) {
				Stock_item::where('id', $c->id)->update(array(
					'transaction_id' => $payment->id,
					'sold' => 1,
					'listed' => 0
				));
			}
			Cart::destroy();
			return true;
		} else {
			return false;
		}
    }

    public function dailyReport($datestart = null, $dateend = null)
    {   

        $transactions = Transaction::with('stock_items')->whereBetween('created_at', array($datestart, $dateend))->get();
    	$sum = DB::table('transactions')->whereBetween('created_at', array($datestart, $dateend))->get(array(
    		DB::raw('SUM(cash) AS cash'),
    		DB::raw('SUM(bank_transfer) AS bank_transfer'),
    		DB::raw('SUM(eftpos) AS eftpos'),
    		DB::raw('SUM(paypal) AS paypal'),
            DB::raw('SUM(total) AS total')
    	));
    	$data = array(
    		'transactions' => $transactions,
    		'sum' => $sum,
    		'date' => $datestart->toFormattedDateString()
    	);
    	return $data;
    }

    public function sum($id)
    {
        if($id) {
        $trans = Transaction::find($id);
        $sum = $trans->total - ($trans->cash + $trans->eftpos + $trans->bank_transfer + $trans->paypal);
        return $sum;
        }
    }

}