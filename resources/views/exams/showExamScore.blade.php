@extends('layouts.layout_student')

@section('title')
	Your Score
@stop

@section('page-content')

<!-- page content -->
<div class="right_col" role="main">
	@if(Session::has('flash_message'))
    <div class="alert alert-{{ Session::get('type_message') }} alert-dismissible fade in" id="viewAlert" style="margin-top:5%"  role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>{{ strtoupper(Session::get('type_message') == 'danger' ? 'error' : Session::get('type_message')) }} : </strong> {!! Session::get('flash_message') !!}
    </div>
	@endif
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Your Score</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <input type="hidden" id="correctAnswers" value="{{$correct}}">
        <input type="hidden" id="wrongAnswers" value="{{$wrong}}">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="width:50%;border-color:white;">
          <h1>{{$correct}}/{{$correct+$wrong}}</h1>
          <canvas id="canvasDoughnut" border="none">
          </canvas>
        </div>
    	</div>
  	</div>
	</div>
</div>
@stop
