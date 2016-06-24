@extends('layouts.layout_student')

@section('title')
	My Progress
@stop

@section('page-content')

<!-- page content -->
<div class="right_col" role="main">
	@if( (Session::has('flash_message')) && (Session::get('flash_message') != 'has-error') )
    <div class="alert alert-{{ Session::get('type_message') }} alert-dismissible fade in" id="viewAlert" style="margin-top:5%"  role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>{{ strtoupper(Session::get('type_message') == 'danger' ? 'error' : Session::get('type_message')) }} : </strong> {!! Session::get('flash_message') !!}
    </div>
	@endif
  <div class="">
    <div class="page-title">
      <div class="title_left">
				<?php $i = 1;?>
				<input type="hidden" id="exams" value="{{count($scores)}}">
				@foreach($scores as $sc)
					<input type="hidden" id="examName{{$i}}" value="{{$sc->exam_name}}">
					<input type="hidden" id="percentage{{$i}}" value="{{$sc->percentage}}">
					<?php $i++;?>
				@endforeach
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Your Progress</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div id="graph_bar" style="width:100%; height:280px;"></div>
                </div>
              </div>
      </div>
  	</div>
	</div>
</div>
@stop
