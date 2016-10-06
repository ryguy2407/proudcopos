<?php

interface TransactionInterface {
	public function getAll();
	public function get($id);
	public function createFromSession($sessionid, $payment_type, $amount);
	public function complete($sum, $total);
	public function dailyReport($datestart, $dateend);
	public function sum($id);
}