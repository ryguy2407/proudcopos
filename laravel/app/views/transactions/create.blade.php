@extends('layouts.main')

@section('content')

@if (Session::has('message'))
	<div class="flash">
		{{ Session::get('message') }}
	</div>
@endif

<h1>Create a new transaction</h1>

		<h1>{{ $stock_item->stock_description }}</h1>

@stop