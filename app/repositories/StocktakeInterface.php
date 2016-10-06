<?php

interface StocktakeInterface {
	public function getAll();
	public function create($lineitems);
	public function update($id, $lineitems);
	public function find($id);
}