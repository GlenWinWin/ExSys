@extends('layouts.layout_student')

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
									<div class="col-md-4 col-sm-4 col-xs-12" style="width: 24%">
										<div class="well profile_view">
											<div class="col-sm-12">
												<h4 class="brief"><i>{{$member->typeOfUser == 2 ? 'Professor' : 'Student'}}</i></h4>
												<div class="left col-xs-7">
													<h2>{{$member->name}}</h2>
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
								<h3>
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
												<small>Added {{$exam_list->date_added}}</small>
											</td>
												@if($exam_list->ifTaken == '0')
												<td>
														<a onclick="takeExam({{$exam_list->exam_id}},{{$groupId}})" class="btn btn-primary">Take Exam</a>
												</td>
												@else
												<td>
													  <a onclick="showScore({{$exam_list->exam_id}})" class="btn btn-success">View Results</a>
												</td>
												@endif
										</tr>
										@endforeach
									</tbody>
									</table>
								</center>
								@else
									<h1> No Exams Yet <i class="fa fa-info"/></i> </h1>
									@endif
								</h3>
							</div>
						</div>
					</div>
				</div>
      </div>
			{!! Form::open(array('action' => 'ExamsController@takeExam' , 'method' => 'post' , 'id' => 'specificExamIdForm'))!!}
			 <input type="hidden" name="examId" id="specific_id">
			 <input type="hidden" name="groupId" id="specific_group_id">
			{!! Form::close()!!}
			{!! Form::open(array('action' => 'ExamsController@showScore' , 'method' => 'get' , 'id' => 'showExamScoreForm'))!!}
			 <input type="hidden" name="examId" id="specific_id">
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
