@extends('layouts.main')

@section('content')
	<h1>Stocktake Reports</h1>	

	@if($reports)
	<table>
			<tr>
				<th>Report Id</th>
				<th>Report Date</th>
				<th>Actions</th>
			</tr>
		@foreach($reports as $report)
			<tr>
				<td>{{ $report->id }}</td>
				<td>{{ date('F j, Y', strtotime($report->created_at)) }}</td>
				<td>{{ link_to_route('stocktake.report', 'Show Report', array($report->id)) }}</td>
			</tr>
		@endforeach
	</table>
	@endif

@stop