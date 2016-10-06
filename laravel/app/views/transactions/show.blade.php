@extends('layouts.main')

@section('content')

@if (Session::has('message'))
	<div class="flash">
		{{ Session::get('message') }}
	</div>
@endif

<h1>Complete Transaction - {{ date('F j, Y', strtotime($transactions->created_at)) }}</h1>
<table>
	<tr>
		<th>Stock Number</th>
		<th>Stock Description</th>
		<th>Sale Price</th>
	</tr>
@foreach($transactions->stock_items()->get() as $stock)
	<tr>
		<td>{{ $stock->stock_number }}</td>
		<td>{{ $stock->stock_description }}</td>
		<td>{{ money_helper($stock->sale_price) }}</td>
	</tr>
@endforeach
</table>

<table>
	<tr>
		<th>Total</th>
	</tr>
	<tr>
		<td>{{ money_helper($transactions->total) }}</td>
	</tr>
</table>

@stop