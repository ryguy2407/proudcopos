@extends('layouts.main')

@section('content')
	<h1>Stocktake Report ID: {{ $report->id }} Created: {{ $report->created_at }}</h1>
	
	<h2>Items not found in the database</h2>
	@if($not_found)
		<table id="stockTable">
			<thead>
			<tr>
				<th>Stock Number</th>
				<th>Stock Description</th>
				<th>Listed</th>
				<th>Sold</th>
				<th>Account</th>
			</tr>
			</thead>
			<tbody>
			@foreach($not_found as $n)
				<tr>
					<td>{{ $n->stock_number }}</td>
					<td>{{ $n->stock_description }}</td>
					<td>{{ bool_to_string($n->listed) }}</td>
					<td>{{ bool_to_string($n->sold) }}</td>
					<td>{{ $n->account }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{ link_to_route('stocktake.edit', 'Continue Scanning Items', array($report->id), array('class' => 'button')) }}
	@else
		<div class="success">
			<p>All items are accounted for</p>
		</div>
	@endif
@stop