<?php

interface LineItemInterface {
	public function getAll();
	public function find($id);
	public function create($stockid);
	public function create_where($id, $stockid);
}