@extends('layouts.main')

@section('content')

@if (Session::has('message'))
	<div class="flash">
		{{ Session::get('message') }}
	</div>
@endif
<h1>Stock Items</h1>

<ul class="status">
	<li>{{ link_to('/', 'All Items') }}</li>
	<li>{{ link_to('stock_items/status/new', 'New') }}</li>
	<li>{{ link_to('stock_items/status/sent', 'Sent') }}</li>
	<li>{{ link_to('stock_items/status/ProudCo', 'Proud Co') }}</li>
	<li>{{ link_to('stock_items/status/PT', 'PT') }}</li>
	<li>{{ link_to('stock_items/status/Tracey', 'Tracey') }}</li>
</ul>

<table id="stockTable">
	<thead>
	<tr>
		<th>Update</th>
		<th>Stock #</th>
		<th>Stock Description</th>
		<th>Listed</th>
		<th>Sold</th>
		<th>Price</th>
		<th>Created On</th>
		<th>Account</th>
		<th>Actions</th>
	</tr>
	</thead>
	{{ Form::open(array('url' => 'stock_items/bulk-update')) }}
	<tbody>
@foreach($stock as $s)
	<tr>
		<td><input type="checkbox" name="check_<?php echo $s->id ?>"></td>
		@if($s->stock_number)
			<td>{{ $s->stock_number }} {{ get_barcode($s->stock_number) }}</td>
		@endif
		<td>{{ $s->stock_description }}</td>
		<td>{{ bool_to_string($s->listed) }}</td>
		<td>{{ bool_to_string($s->sold) }}</td>
		<td>{{ sprintf('$%.2f', $s->sale_price) }}</td>
		<td>{{ date('F j, Y', strtotime($s->created_at)) }}</td>
		<td>{{ $s->account }}</td>
		<td>
			{{ link_to_route('stock_items.edit', 'Edit', array($s->id)) }}
			| {{ link_to_route('stock_items.barcode', 'Generate Barcode', array($s->id), array('target' => '_blank')) }}
			@if($s->transaction_id)
			| {{ link_to_route('transaction.show', 'View Transaction', array($s->transaction_id)) }}
			@endif
		</td>
	</tr>
@endforeach
	</tbody>
</table>

	{{ $stock->links() }}

	<div style="margin-top:10px">
	{{ Form::select('edit_status', array(
		'listed' => 'Mark as listed', 
		'unlisted' => 'Mark as unlisted',
		'sold' => 'Mark as sold',
		'unsold' => 'Mark as unsold',
		'sent' => 'Mark as sent item',
		'proudco' => 'Mark as ProudCo item',
		'tracey' => 'Mark as Tracey item',
		'pt' => 'Mark as PT item' )) }}
	{{ Form::submit('Bulk update') }}
	</div>
	{{ Form::close() }}
@stop