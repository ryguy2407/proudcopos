@extends('layouts.main')

@section('content')

@if (Session::has('message'))
	<div class="flash">
		{{ Session::get('message') }}
	</div>
@endif

<h1>Sales Reports For: {{ $date }}</h1>
{{ Form::open(array('url' => 'monthly/reports', 'method' => 'post', 'class' => 'dateform')) }}
		{{ Form::label('start_date', 'Start Date') }}
		<input type="date" name="start_date" id="date" value="" />
		{{ Form::label('end_date', 'End Date') }}
		<input type="date" name="end_date" id="date" value="" />
		{{ Form::submit('Submit') }}
	{{ Form::close() }}

<div class="primary">

<h1 style="margin-top:30px;">Monthly Totals:</h1>
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