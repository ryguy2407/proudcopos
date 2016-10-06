@extends('layouts.main')

@section('content')

@if (Session::has('message'))
	<div class="flash">
		{{ Session::get('message') }}
	</div>
@endif

<h1>Sales Reports For: {{ $date }}</h1>
{{ Form::open(array('url' => 'sales/reports', 'method' => 'post', 'class' => 'dateform')) }}
		{{ Form::label('date', 'Select a day to generate report') }}
		<input type="date" name="date" id="date" value="" />
		{{ Form::submit('Submit') }}
	{{ Form::close() }}

<div class="primary">
	
<table class="cart">
@foreach($transactions as $t)
		<tr>
			<th colspan="2">Transaction id: {{ $t->id }}</th>
		</tr>
		<!-- id: {{ $t->id }}, total: {{ money_helper($t->total) }} -->
		@foreach($t->stock_items as $stock)
			<tr>
				<td>{{ $stock->stock_description }}</td>
				<td>
					{{ money_helper($stock->sale_price) }}
				</td>
			</tr>
		@endforeach
@endforeach

</table>

<h1 style="margin-top:30px;">Daily Totals:</h1>
@if($sum) 
<table class="cart">
	<tr>
		<th>Cash</th>
		<th>Eftpos</th>
		<th>Bank Transfer</th>
		<th>Paypal</th>
	</tr>
	<tr>
		<td>{{ money_helper($sum[0]->cash) }}</td>
		<td>{{ money_helper($sum[0]->eftpos) }}</td>
		<td>{{ money_helper($sum[0]->bank_transfer) }}</td>
		<td>{{ money_helper($sum[0]->paypal) }}</td>
	</tr>
	<tr>
		<td colspan="4"><strong>TOTAL:</strong> {{ money_helper($sum[0]->total) }}</td>
	</tr>
</table> 
@endif
</div><!-- end primary -->

@stop