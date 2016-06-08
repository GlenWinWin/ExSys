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
				<div class="" role="tabpanel" data-example-id="togglable-tabs" style="width:100%">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class="active"><a href="#members_tab" role="tab" data-toggle="tab" aria-expanded="true">Members</a>
						</li>
						<li role="presentation" class=""><a href="#exam_tab" role="tab" data-toggle="tab" aria-expanded="true">Exam</a>
						</li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="members_tab" aria-labelledby="members_tab">
							<div class="row" id="wider1" style="height: 440px;overflow-y: auto;">
									<div class="clearfix"></div>
									@foreach($members as $member)
									<div class="col-md-4 col-sm-4 col-xs-12">
										<div class="well profile_view">
											<div class="col-sm-12">
												<h4 class="brief"><i>{{$member->typeOfUser == 2 ? 'Professor' : 'Student'}}</i></h4>
												<div class="left col-xs-7">
													<h2>{{$member->name}}</h2>
													<p><strong>About: </strong> Web Designer / UI. </p>
													<ul class="list-unstyled">
														<li><i class="fa fa-phone"></i> Address: </li>
														<li><i class="fa fa-phone"></i> Address: </li>
													</ul>
												</div>
												<div class="right col-xs-5 text-center">
													<img src="{{$member->profile_path}}" alt="" class="img-circle img-responsive">
												</div>
											</div>
										</div>
									</div>
									@endforeach
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="exam_tab" aria-labelledby="exam_tab">
							<div class="row" id="wider2">
								<h3><a onclick="setGroupId({{$groupId}})" class="btn btn-info">Create Exam</a></h3>
									@if(count($exams) > 0)
									<center>
										<table class="table table-hover" align="center">
											<thead>
												<tr>
													<th>Exam Name</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($exams as $exam_list)
												<tr>
	                        <td>
	                          {{$exam_list->exam_name}}
	                          <br />
	                          <small>Created {{$exam_list->date_added}}</small>
	                        </td>
	                        <td>
	                          <a onclick="viewExamResults({{$exam_list->exam_id}})" class="btn btn-primary"><i class="fa fa-folder"></i> View Results</a>
	                          <a onclick="editExam({{$exam_list->exam_id}})" class="btn btn-info"><i class="fa fa-pencil"></i> Edit </a>
	                          <a href="#" class="btn btn-danger "><i class="fa fa-trash-o"></i> Delete </a>
														<a href="#" class="btn btn-warning "><i class="fa fa-share-alt"></i> Share </a>
	                        </td>
	                      </tr>
												@endforeach
											</tbody>
										</table>
									</center>
									@endif
							</div>
						</div>
					</div>
				</div>
      </div>
				{!! Form::open(array('action' => 'ExamsController@createExamInfo' , 'method' => 'post' , 'id' => 'specificGroupIdForm'))!!}
				 <input type="hidden" name="groupId" id="specific_id">
				{!! Form::close()!!}
				{!! Form::open(array('action' => 'ExamsController@updateYourExam' , 'method' => 'get' , 'id' => 'editExam'))!!}
				 <input type="hidden" name="exam_id" id="exam_id">
				{!! Form::close()!!}
				{!! Form::open(array('action' => 'ExamsController@viewtheResult' , 'method' => 'get' , 'id' => 'viewExamResults'))!!}
				 <input type="hidden" name="view_id" id="viewexamResultsId">
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
<script src="{{ URL::asset('assets/js/icheck/icheck.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/progressbar/bootstrap-progressbar.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/pace/pace.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#viewAlert").fadeTo(3000, 500).fadeOut(500, function(){
	});
});
</script>
@stop
