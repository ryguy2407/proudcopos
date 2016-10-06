@extends('layouts.main')
@section('content')
<h1>Edit Stock Item: {{ $stock->stock_description }}</h1>

{{ Form::model($stock, array('method' => 'PATCH', 'route' => array('stock_items.update', $stock->id), 'id' => 'form')) }}

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

	{{ Form::submit('Submit') }}

{{ Form::close() }}
@stop