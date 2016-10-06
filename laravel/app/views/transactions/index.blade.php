@extends('layouts.main')

@section('content')

@if (Session::has('message'))
	<div class="flash">
		{{ Session::get('message') }}
	</div>
@endif

<h1>All Transactions</h1>

<table class="cart">
@foreach($transactions as $t)
		<tr>
			<th colspan="2">Transaction id: {{ $t->id }}</th>
		</tr>
		<!-- id: {{ $t->id }}, total: {{ money_helper($t->total) }} -->
		@foreach($t->stock_items as $stock)
			<tr>
				<td>{{ $stock->stock_description }}</td>
				<td>{{ money_helper($stock->sale_price) }}</td>
			</tr>
		@endforeach
		<tr>
			<td><strong>Total:</strong></td>
			<td>{{ money_helper($t->total) }}</td>
		</tr>

@endforeach
</table>

@stop