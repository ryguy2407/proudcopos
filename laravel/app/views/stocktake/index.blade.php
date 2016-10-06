@extends('layouts.main')

@section('content')
	<h1>Perform a Stocktake</h1>

	{{ Form::open((array('url' => 'stocktake', 'method' => 'post'))) }}
		<p>Scan or lookup item to add to the stocktake report: {{ Form::text('stock_search', '', array('id' => 'stock_search')) }}</p>
	{{ Form::close() }}

	@if($lineitems)
		<table>
			<tr>
				<th>Stock Number</th>
				<th>Stock Description</th>
				<th>Listed</th>
				<th>Sold</th>
			</tr>
		@foreach($lineitems as $item)
			<tr>
				<td>{{ $item->stock_item()->first()->stock_number }}</td>
				<td>{{ $item->stock_item()->first()->stock_description }}</td>
				<td>{{ bool_to_string($item->stock_item()->first()->listed) }}</td>
				<td>{{ bool_to_string($item->stock_item()->first()->sold) }}</td>
			</tr>
		@endforeach
		</table>
		{{ link_to_route('stocktake.create', 'Create a Stocktake Report', array(), array('class' => 'button')) }}
	@endif
@stop