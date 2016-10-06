<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ProudCo POS</title>
  <link href="{{ URL::asset('style.css') }}" rel="stylesheet" type="text/css" media="screen" />
  <link href="{{ URL::asset('print.css') }}" rel="stylesheet" type="text/css" media="print" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('jquery.tablesorter.min.js') }}"></script>
  <script>
   	$(document).ready(function(){
   		$('#form').keypress(function(e){
     			if(e.which === 13){
         		return false;
    		}
		 });
		$('#stock_search').focus();

		$("table#stockTable").tablesorter(); 
   	});
  </script>
</head>
<body>
 
	<div class="headerContainer">
		<div class="logo">
			<img src="{{ URL::asset('images/logo.png') }}" alt="" width="220">
		</div><!-- end logo -->
		<div class="search">
			{{ Form::open(array('url' => 'search', 'method' => 'POST')) }}
				<p>Search Stock: 
					<input type="text" name="search">
					<input type="submit" value="Search">
				</p>
			{{ Form::close() }}
		</div><!-- end search -->

		<div class="nav">
			<ul>
				<li>{{ link_to('/', 'Dashboard') }}</li>
				<li>{{ link_to_route('stock_items.create', 'Add Stock') }}</li>
				<li>{{ link_to_route('sales', 'Add A Sale') }}</li>
				<li>{{ link_to_route('sales.reports', 'Daily Reports') }}</li>
				<li>{{ link_to_route('monthly.reports', 'Monthly Reports') }}</li>
				<li>
					{{ link_to_route('stocktake.index', 'Stocktake') }}
					<ul>
						<li>{{ link_to('stocktake', 'Perform Stocktake') }}</li>
						<li>{{ link_to('stocktake/reports', 'Reports') }}</li>
					</ul>
				</li>
			</ul>
		</div><!-- end nav -->
	</div><!-- end headerContainer -->
            
<div class="container">
	@if (Session::has('message'))
		<div class="errors">
			{{ Session::get('message') }}
		</div>
	@endif

	@if (Session::has('success'))
		<div class="success">
			{{ Session::get('success') }}
		</div>
	@endif

	@yield('content')
</div><!-- end stockContainer -->
 
</body>
</html>