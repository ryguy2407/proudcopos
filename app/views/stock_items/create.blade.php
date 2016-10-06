@extends('layouts.main')
@section('content')
<h1>Add New Stock Item</h1>

@if ($errors->any())
    <div class="errors">
	    <ul>
	        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
	    </ul>
    </div>
@endif

{{ Form::open(['url' => 'stock_items', 'method' => 'POST', 'files' => true, 'id' => 'form']) }}

	<div>
		{{ Form::label('stock_number', 'Stock Number') }}
		{{ Form::text('stock_number') }}
	</div>

	<div>
		{{ Form::label('stock_description', 'Stock Description') }}
		{{ Form::text('stock_description') }}
	</div>

	<div>
		{{ Form::label('listed', 'Listed') }}
		{{ Form::select('listed', ['0' => 'No', '1' => 'Yes']) }}
	</div>

	<div>
		{{ Form::label('sold', 'Sold') }}
		{{ Form::select('sold', ['0' => 'No', '1' => 'Yes']) }}
	</div>

	<div>
		{{ Form::label('sale_price', 'Sale Price') }}
		{{ Form::text('sale_price') }}
	</div>

	{{ Form::submit('Submit', ['id' => 'submit']) }}

{{ Form::close() }}
@stop