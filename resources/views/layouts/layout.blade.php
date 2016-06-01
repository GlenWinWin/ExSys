<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/custom.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/green.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/fonts/font-awesome.min.css')}}" rel="stylesheet">
</head>
<body style="background:#F7F7F7;">

	@include('layouts.menu')
	@if(Session::has('flash_message'))
    	<div class="alert alert-{{ Session::get('type_message') }}" id="showMessage">
    		<b>{!! Session::get('flash_message') !!}<b>
    	</div>
	@endif
	@yield('body')
	<script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
                $("#showMessage").fadeTo(3000, 500).slideUp(500, function(){
                });
            });
</script>
