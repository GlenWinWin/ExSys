@extends('layouts.layout_professor')

@section('title')
	Preview
@stop

@section('page-content')

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Preview Exam</h3>
      </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" style="height:100%;">
					{!! Form::open(array('action' => 'ExamsController@submitExam' , 'method' => 'post' , 'id' => 'formExam'))!!}
					<div class="x_title">
						<div class="form-group" >
						<label class="control-label col-md-3" for="first-name" style="width:9%;margin-left:4%;margin-top:1%;">Time Limit:
				</label>
						<div class="col-md-3">
							<div id="clockdiv">
							  <div>
							    <span class="hours">00</span>
							  </div>
							  <div>
							    <span class="minutes">00</span>
							  </div>
							  <div>
							    <span class="seconds">00</span>
							  </div>
							</div>
					</div>
				</div>
				<input type="hidden" name="totalQuestions" value="{{$true_false+$multiple_choice+$identification}}">
				<input type="hidden" name="exam_id" value="{{$examId}}">
				<input type="hidden" name="group_id" value="{{$groupId}}">
				<!-- <button type="button" class="btn btn-primary" style="float:right" data-toggle="modal"
				data-target="#confirm-exam" onclick="makingSure({{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})">Done</button> -->
				<h1 style="float:right;margin-right:5%" id="doneQuestion">0/{{$true_false+$multiple_choice+$identification}}</h1>
					                      <div class="clearfix"></div>
					</div>
					<div class="numques">
						<h2>Questions</h2><br>
						<?php $i=1;?>
						@foreach($questions as $tanong)
									<a  id="myAnchor{{$i}}" onclick="showEach('newboxes{{$i}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$i}})">
										{{$i}}
									</a>
							<?php $i++;?>
						@endforeach
					</div>
					<?php $q=1;?>
					@foreach($questions as $quest)
					<div class="showQuestion">
						@if($q == 1 && $quest->type_of_question == 'true_or_false')
							<div class="newboxes" id="newboxes{{$q}}">
							<div class="form-group">
								<h3> True or False</h3>
								<label for="message">Question {{$q}}:</label>
								<textarea class="form-control" readonly="readonly" name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>

																												<label>Answer:</label>
																												<br>
																												<div class="btn-group" data-toggle="buttons" >
																													<label class="btn btn-default">
																														<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="true"> True
																													</label>

																													<label class="btn btn-default">
																														<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="false"> False
																													</label>

																												</div>
																												<a style="float:right" onclick="showEach('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
								</div>
								</div>
						@elseif($q == 1 && $quest->type_of_question == 'multiple_choice')
						<div  class="newboxes" id="newboxes{{$q}}">
							<div class="form-group">
								<h3> Multiple Choice</h3>
								<label for="message">Question {{$q}} :</label>
								<textarea readonly="readonly" class="form-control" name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>
										<label>Answer:</label>
	<br>
										<div class="btn-group" data-toggle="buttons" >
										<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="option_mul{{$q}}" value="a">A
								</label><div class="col-md-7">
									<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}" readonly="readonly" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="option_mul{{$q}}" value="b">B
								</label><div class="col-md-7">
									<input type="text" id="b{{$q}}" name="b{{$q}}" readonly="readonly" value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="option_mul{{$q}}" value="c">C
								</label><div class="col-md-7">
									<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}" readonly="readonly" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="option_mul{{$q}}" value="d">D
								</label><div class="col-md-7">
									<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}" readonly="readonly" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div>
									</div>
									<a style="float:right" onclick="showEach('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
								</div>
							</div>
							@elseif($q == 1 && $quest->type_of_question == 'identification')
							<div class="newboxes" id="newboxes{{$q}}">
										<div class="form-group">
								<h3>Identification/ Fill in the Blanks</h3>
								<label for="message">Question {{$q}} :</label>
								<textarea class="form-control" readonly="readonly" name="question[]" style="margin-bottom:10px; background-color: #FFF;" >{{$quest->question}}</textarea>
										<label>Answer:</label>
										<div class="control-group">
											<div class="col-md-3 col-sm-3 col-xs-12" style="margin-left: -10px;" >
												<input type="text" id="ident{{$q}}" class="tags form-control" name="iden{{$q}}">
											</div>
										</div>
										<a style="float:right" onclick="showEach('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
										</div>
							</div>
							@elseif($q != 1 && $quest->type_of_question == 'true_or_false')
								<div class="newboxes" id="newboxes{{$q}}" style="display:none">
									<div class="form-group">
										<h3> True or False</h3>
										<label for="message">Question {{$q}}:</label>
										<textarea class="form-control" readonly="readonly" name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>

																														<label>Answer:</label>
																														<br>
																														<div class="btn-group" data-toggle="buttons" >
																															<label class="btn btn-default">
																																<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="true"> True
																															</label>

																															<label class="btn btn-default">
																																<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="false"> False
																															</label>

																														</div>
																														@if($q < count($questions))
																														<a style="float:right" onclick="showEach('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
																														@endif
																														<a style="float:right" onclick="showEach('newboxes{{$q-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
										</div>
									</div>
							@elseif($q != 1 && $quest->type_of_question == 'multiple_choice')
							<div  class="newboxes" id="newboxes{{$q}}" style="display:none">
							<div class="form-group">
								<h3> Multiple Choice</h3>
								<label for="message">Question {{$q}} :</label>
								<textarea readonly="readonly" class="form-control" name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>
										<label>Answer:</label>
	<br>
										<div class="btn-group" data-toggle="buttons" >
										<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="option_mul{{$q}}" value="a">A
								</label><div class="col-md-7">
									<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}" readonly="readonly" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="option_mul{{$q}}" value="b">B
								</label><div class="col-md-7">
									<input type="text" id="b{{$q}}" name="b{{$q}}" value="{{$quest->b}}" readonly="readonly" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="option_mul{{$q}}" value="c">C
								</label><div class="col-md-7">
									<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}" readonly="readonly" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="option_mul{{$q}}" value="d">D
								</label><div class="col-md-7">
									<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}" readonly="readonly" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div>
									</div>
									@if($q < count($questions))
									<a style="float:right" onclick="showEach('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
									@endif
									<a style="float:right" onclick="showEach('newboxes{{$q-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
								</div>
								</div>
							@else
							<div class="newboxes" id="newboxes{{$q}}" style="display:none">
										<div class="form-group">
								<h3>Identification/ Fill in the Blanks</h3>
								<label for="message">Question {{$q}} :</label>
								<textarea readonly="readonly"readonly="readonly" class="form-control" name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>
										<label>Answer:</label>
										<div class="control-group">
											<div class="col-md-3 col-sm-3 col-xs-12" style="margin-left: -10px;" >
												<input type="text" id="ident{{$q}}" class="tags form-control" name="iden{{$q}}">
											</div>
										</div>
										@if($q < count($questions))
										<a style="float:right" onclick="showEach('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
										@endif
										<a style="float:right" onclick="showEach('newboxes{{$q-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}},{{$q}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
										</div>
							</div>
							@endif
							<?php $q++;?>
							</div>
						@endforeach
						{!! Form::close()!!}
											</div>

					</div>
      </div>
    </div>
		{!! Form::open(array('action' => 'GroupController@viewGroupStudent', 'method' => 'post' , 'id' => 'specificGroup'))!!}
		 <input type="hidden" name="groupId" id="specific_group_id">
		{!! Form::close()!!}
		<div class="modal fade bs-example-modal-sm" id="reminders" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">

					<div class="modal-header">
						</button>
						<h4 class="modal-title" id="myModalLabel2">Reminders</h4>
					</div>
					<div class="modal-body">
						<h4>Note:</h4>
						<p>Are you ready to take the exam? </p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="setClock({{$time_limit}})" style="margin-right:0px;">Yes, I am ready!</button>
						<a class="btn btn-default" onclick="setHiddenSpecificId({{$groupId}})" style="margin-right:0px;">Give me some more time.</a>
					</div>
				</div>
			</div>
		</div>
  </div>
	<div class="modal fade bs-example-modal-sm" id="confirm-exam" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel2">Reminders</h4>
				</div>
				<div class="modal-body">
					<h4>Note:</h4>
					<p>
						Are you sure you want to submit the Exam?
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" style="margin-top:1%" onclick="submitAnswers()">Proceed</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="count_hidden">
	@for($i = 1; $i <= count($questions);$i++)
	<input type="hidden" id="{{$i}}">
	@endfor
@stop
