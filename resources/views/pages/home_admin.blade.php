@extends('layouts.layout_admin')

@section('title')
	Admin
@stop

@section('page-content')

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Authorized Personnel Only</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

    	</div>
  	</div>
	</div>
</div>

@stop

@section('js_script')
<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/custom.js')}}"></script>
@stop
