@extends('layouts.main')

@section('content')

<h1>Sales Register</h1>

{{ Form::open((array('url' => 'sales', 'method' => 'post'))) }}
	<p>Scan or lookup item to add to the checkout: {{ Form::text('stock_search', '', array('id' => 'stock_search')) }}</p>
{{ Form::close() }}

<div class="primary">
@if($cart)
	<table class="cart">
		<tr>
			<th>Item Name</th>
			<th>Price</th>
			<th>Actions</th>
		</tr>
		@foreach($cart as $c)
		<tr>
			<td>{{ $c->name }}</td>
			<td>{{ money_helper($c->price) }}</td> 
			<td>{{ link_to_route('sales.deleteitem', 'Delete Item', array($c->id)) }}</td>
		</tr>
		@endforeach
	</table>
@else
	<div class="errors">
		<p>There are no items in the checkout, start scanning above to add some</p>
	</div>
@endif
</div><!-- end primary -->

<div class="secondary">
	<table class="cart secondary">
		<tr>
			<th>Payment Options</th>
		</tr>
		<tr>
			<td>
				{{ Form::open(array('url' => 'transaction/add', 'method' => 'post')) }}
					{{ Form::select('payment_type', array('cash' => 'Cash', 'eftpos' => 'Eftpos', 'bank_transfer' => 'Bank Transfer', 'paypal' => 'Paypal'), 'cash') }}
					{{ Form::text('amount', '', array('placeholder' => 'Type Payment Amount')) }}
					{{ Form::submit('Add Payment') }}
				{{ Form::close() }}
			</td>
		</tr>
		<tr>
				<td>
					<table>
						@if($transactions)
						<tr>
							<td>Cash:</td>
							<td>{{ money_helper($transactions->cash) }}</td>
						</tr>
						<tr>
							<td>Eftpos:</td>
							<td>{{ money_helper($transactions->eftpos) }}</td>
						</tr>
						<tr>
							<td>Bank Transfer:</td>
							<td>{{ money_helper($transactions->bank_transfer) }}</td>
						</tr>
						<tr>
							<td>Paypal:</td>
							<td>{{ money_helper($transactions->paypal) }}</td>
						</tr>
						@if($sum)
							<tr>
								<td>Remaining:</td>
								<td class="red">{{ money_helper($sum) }}</td>
							</tr>
						@endif <!-- END SUM IF -->
						@endif <!-- EDN TRANSACTION IF -->
							<tr>
								<td>Total:</td>
								<td class="green">{{ money_helper(Cart::total()) }}</td>
							</tr>
					</table>
				</td>
		</tr>
	</table>

	{{ link_to_route('sales.delete', 'Clear Payments', array(), array('class' => 'reset')) }}
</div><!-- end secondary -->

@stop