<?php

interface StockItemInterface {
	public function getAll();
	public function find($id);
	public function store($data);
	public function update($data);
	public function where($search_term);
	public function findWhere($query);
	public function findStatus($status);
}