@extends('layouts.layout_professor')

@section('title')
	Group
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
        <h3>{{$groupName}}</h3>
								<h3><a onclick="setGroupId({{$groupId}})" class="btn btn-info">Create Exam</a></h3>
								<h3>
									@foreach($exams as $exam_list)
										<a onclick="editExam({{$exam_list->exam_id}})" class="btn btn-primary">{{$exam_list->exam_name}}</a>
										<a class="btn btn-primary"><i class="fa fa-print" style="margin-right:5px;"></i>Print</a>
									@endforeach
								</h3>
      </div>
				{!! Form::open(array('action' => 'ExamsController@createExamInfo' , 'method' => 'post' , 'id' => 'specificGroupIdForm'))!!}
				 <input type="hidden" name="groupId" id="specific_id">
				{!! Form::close()!!}

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
<script src="{{ URL::asset('assets/js/specific_group.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#viewAlert").fadeTo(3000, 500).fadeOut(500, function(){
	});
});
</script>
@stop
