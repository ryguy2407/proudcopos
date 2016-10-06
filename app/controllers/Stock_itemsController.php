<?php

class Stock_itemsController extends BaseController {

	protected $stock;

	public function __construct(StockItemInterface $stock)
	{
		$this->stock = $stock;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$stock = $this->stock->getAll();
		return View::make('stock_items.index')->with('stock', $stock);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('stock_items.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new Services\Validators\StockValidator;
        if ($validation->passes()) {
			if (Input::hasFile('image'))
				{
		    		$data['image'] = Input::file('image')->getRealPath();	
				}

				$this->stock->store(Input::all());

				return Redirect::route('stock_items.index')->with('success', 'Item added');
		} else {
			return Redirect::route('stock_items.create')
            ->withInput()
            ->withErrors($validation->errors)
            ->with('message', 'There were validation errors.');
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
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$stock = $this->stock->find($id);
        if (is_null($stock))
        {
            return Redirect::route('stock_items.index');
        }

        return View::make('stock_items.edit', compact('stock'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$stock = $this->stock->find($id);
        $stock->update($input);
		return Redirect::route('stock_items.index')->with('success', 'Stock item successfully Edited');
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

	public function bulkUpdate()
	{
		foreach ($_POST as $key => $value)
		{
  			if (strpos($key,'check_') !== false)
  			{
     			list($tmp, $ID) = explode('_', $key);

      			$CheckedValues[] = $ID;
			} 
		}
		foreach($CheckedValues as $check) {
			$input = Input::get('edit_status');
			$stock = $this->stock->find($check);
			
			if ($input == 'listed') $stock->listed = 1;
			if ($input == 'unlisted') $stock->listed = 0;
			if ($input == 'sent') $stock->account = 'Sent';
			if ($input == 'sold') $stock->sold = 1;
			if ($input == 'unsold') $stock->sold = 0;
			if ($input == 'proudco') $stock->account = 'ProudCo';
			if ($input == 'tracey') $stock->account = 'Tracey';
			if ($input == 'pt') $stock->account = 'PT';

			$stock->save();
		}
		return Redirect::route('stock_items.index')->with('success', 'Stock items successfully Edited');
	}

	public function generateBarcode($id)
	{
		$barcode = new Services\Barcodes\barcodeGenerator;
		$barcode->generate($id);
	}

	public function getStatus($status)
	{
		if($status === 'new') { $status = NULL; }
		$stock = $this->stock->findStatus($status);
		return View::make('stock_items.index')->with('stock', $stock);
	}

}