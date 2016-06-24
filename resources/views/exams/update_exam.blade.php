@extends('layouts.layout_professor')

@section('title')
	Edit Exam
@stop

@section('page-content')

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Update your Exam</h3>
      </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" style="height:100%;">
					{!! Form::open(array('action' => 'ExamsController@createExam' , 'method' => 'post' , 'id' => 'formQuestion'))!!}
					<div class="x_title">
						<h2 style="margin-top:1%;">{{$examName}}</h2>
						<div class="form-group" >
						<label class="control-label col-md-3" for="first-name" style="width:9%;margin-left:4%;margin-top:1%;">Time Limit:
				</label>
						<div class="col-md-2">
							<input name="timeLimit" type="number" min="1" max="1440" id="time_limit" required="required" value="{{$time_limit}}" class="form-control col-md-2 col-xs-12">
							Minutes
					</div>
					<div class="col-md-2">
						<ul class="to_do">
							<li>
								<p>
									@if($random == 0)
										<input type="checkbox" class="flat" name="check_random" value="1"> Random Questions
									@else
										<input type="checkbox" class="flat" name="check_random" checked="checked" value="1"> Random Questions
									@endif
								</p>
							</li>
						</ul>
					</div>
				</div>
				<input type="hidden" name="examName" value="{{ $examName }}">
				<input type="hidden" name="true_false" value="{{ $true_false }}">
				<input type="hidden" name="multiple_choice" value="{{ $multiple_choice }}">
				<input type="hidden" name="identification" value="{{ $identification }}">
				<input type="hidden" name="groupId" value="{{ $groupId }}">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirm-submit-question" onclick="displayModal({{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" style="float:right;">Update Exam</button>
<div class="clearfix"></div>
					</div>
					<div class="numques">
						<h2>Questions</h2><br>
						@for($i = 1;$i <= $numberOfItems;$i++)
									<a  id="myHeader{{$i}}" ondblclick="removeQuestion({{$i}})" onclick="showonlyone('newboxes{{$i}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})">
										{{$i}}
									</a>
						@endfor
					</div>
					<?php $q=1;?>
					@foreach($questions as $quest)
					<div class="showQuestion">
						@if($q == 1 && $quest->type_of_question == 'true_or_false')
							<div class="newboxes" id="newboxes{{$q}}">
							<div class="form-group">
								<h3> True or False</h3>
								<label for="message">Question {{$q}}:</label>
								<textarea id="question_tf{{$q}}" class="form-control"  name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>

																												<label>Answer:</label>
																												<br>
																												<div class="btn-group" data-toggle="buttons" >
																													@if($quest->answers == 'true')
																													<label class="btn btn-default active">
																														<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="true" checked="checked">True
																													</label>
																													<label class="btn btn-default">
																														<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="false"> False
																													</label>
																													@else
																													<label class="btn btn-default">
																														<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="true"> True
																													</label>
																													<label class="btn btn-default active">
																														<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="false" checked="checked">False
																													</label>
																													@endif
																												</div>
																												<a style="float:right" onclick="showonlyone('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
								</div>
								</div>
						@elseif($q == 1 && $quest->type_of_question == 'multiple_choice')
						<div  class="newboxes" id="newboxes{{$q}}">
							<div class="form-group">
								<h3> Multiple Choice</h3>
								<label for="message">Question {{$q}} :</label>
								<textarea id="question_mul{{$q}}"  class="form-control" name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>
										<label>Answer:</label>
					<br>
										<div class="btn-group" data-toggle="buttons" >
										@if($quest->answers == 'a')
										<label class="btn btn-default active">
									<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="a" checked="checked">A
								</label><div class="col-md-7">
									<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="b">B
								</label><div class="col-md-7">
									<input type="text" id="b{{$q}}" name="b{{$q}}"  value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="c">C
								</label><div class="col-md-7">
									<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="d">D
								</label><div class="col-md-7">
									<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div>
									@elseif($quest->answers == 'b')
									<label class="btn btn-default">
								<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="a">A
							</label><div class="col-md-7">
								<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
							</div><br><br>
								<label class="btn btn-default active">
								<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="b" checked="checked">B
							</label><div class="col-md-7">
								<input type="text" id="b{{$q}}" name="b{{$q}}"  value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
							</div><br><br>
								<label class="btn btn-default">
								<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="c">C
							</label><div class="col-md-7">
								<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
							</div><br><br>
								<label class="btn btn-default">
								<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="d">D
							</label><div class="col-md-7">
								<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
							</div>
							@elseif($quest->answers == 'c')
							<label class="btn btn-default">
						<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="a">A
					</label><div class="col-md-7">
						<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
					</div><br><br>
						<label class="btn btn-default">
						<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="b">B
					</label><div class="col-md-7">
						<input type="text" id="b{{$q}}" name="b{{$q}}"  value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
					</div><br><br>
						<label class="btn btn-default active">
						<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="c" checked="checked">C
					</label><div class="col-md-7">
						<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
					</div><br><br>
						<label class="btn btn-default">
						<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="d">D
					</label><div class="col-md-7">
						<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
					</div>
					@else
					<label class="btn btn-default">
				<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="a">A
			</label><div class="col-md-7">
				<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
			</div><br><br>
				<label class="btn btn-default">
				<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="b">B
			</label><div class="col-md-7">
				<input type="text" id="b{{$q}}" name="b{{$q}}"  value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
			</div><br><br>
				<label class="btn btn-default">
				<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="c">C
			</label><div class="col-md-7">
				<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
			</div><br><br>
				<label class="btn btn-default active">
				<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="d" checked="checked">D
			</label><div class="col-md-7">
				<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
			</div>
			@endif
									</div>
									<a style="float:right" onclick="showonlyone('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
								</div>
							</div>
							@elseif($q == 1 && $quest->type_of_question == 'identification')
							<div class="newboxes" id="newboxes{{$q}}">
										<div class="form-group">
								<h3>Identification/ Fill in the Blanks</h3>
								<label for="message">Question {{$q}} :</label>
								<textarea id="questIden{{$q}}" class="form-control"  name="question[]" style="margin-bottom:10px; background-color: #FFF;" >{{$quest->question}}</textarea>
										<label>Answer:</label>
										<div class="control-group">
											<div class="col-md-3 col-sm-3 col-xs-12" style="margin-left: -10px;" >
												<input type="text" id="tags_{{$q}}" class="tags form-control" onchange="doTag('{{$q}}')" name="iden{{$q}}" value="{{$quest->answers}}">
											</div>
										</div>
										<a style="float:right" onclick="showonlyone('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
										</div>
							</div>
							@elseif($q != 1 && $quest->type_of_question == 'true_or_false')
								<div class="newboxes" id="newboxes{{$q}}" style="display:none">
									<div class="form-group">
										<h3> True or False</h3>
										<label for="message">Question {{$q}}:</label>
										<textarea id="question_tf{{$q}}" class="form-control"  name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>

																														<label>Answer:</label>
																														<br>
																														<div class="btn-group" data-toggle="buttons" >
																															@if($quest->answers == 'true')
																															<label class="btn btn-default active">
																																<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="true" checked="checked">True
																															</label>
																															<label class="btn btn-default">
																																<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="false"> False
																															</label>
																															@else
																															<label class="btn btn-default">
																																<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="true"> True
																															</label>
																															<label class="btn btn-default active">
																																<input type="radio" name="tf{{$q}}" id="tf_option{{$q}}" value="false" checked="checked">False
																															</label>
																															@endif
																														</div>
																														@if($q < count($questions))
																														<a style="float:right" onclick="showonlyone('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
																														@endif
																														<a style="float:right" onclick="showonlyone('newboxes{{$q-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
										</div>
									</div>
							@elseif($q != 1 && $quest->type_of_question == 'multiple_choice')
							<div  class="newboxes" id="newboxes{{$q}}" style="display:none">
							<div class="form-group">
								<h3> Multiple Choice</h3>
								<label for="message">Question {{$q}} :</label>
								<textarea id="question_mul{{$q}}" class="form-control" name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>
										<label>Answer:</label>
					<br>
										<div class="btn-group" data-toggle="buttons" >
											@if($quest->answers == 'a')
											<label class="btn btn-default active">
										<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="a" checked="checked">A
									</label><div class="col-md-7">
										<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
									</div><br><br>
										<label class="btn btn-default">
										<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="b">B
									</label><div class="col-md-7">
										<input type="text" id="b{{$q}}" name="b{{$q}}"  value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
									</div><br><br>
										<label class="btn btn-default">
										<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="c">C
									</label><div class="col-md-7">
										<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
									</div><br><br>
										<label class="btn btn-default">
										<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="d">D
									</label><div class="col-md-7">
										<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
									</div>
										@elseif($quest->answers == 'b')
										<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="a">A
								</label><div class="col-md-7">
									<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default active">
									<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="b" checked="checked">B
								</label><div class="col-md-7">
									<input type="text" id="b{{$q}}" name="b{{$q}}"  value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="c">C
								</label><div class="col-md-7">
									<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="d">D
								</label><div class="col-md-7">
									<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
								</div>
								@elseif($quest->answers == 'c')
								<label class="btn btn-default">
							<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="a">A
						</label><div class="col-md-7">
							<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
						</div><br><br>
							<label class="btn btn-default">
							<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="b">B
						</label><div class="col-md-7">
							<input type="text" id="b{{$q}}" name="b{{$q}}"  value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
						</div><br><br>
							<label class="btn btn-default active">
							<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="c" checked="checked">C
						</label><div class="col-md-7">
							<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
						</div><br><br>
							<label class="btn btn-default">
							<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="d">D
						</label><div class="col-md-7">
							<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
						</div>
						@else
						<label class="btn btn-default">
					<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="a">A
				</label><div class="col-md-7">
					<input type="text" id="a{{$q}}" name="a{{$q}}" value="{{$quest->a}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
				</div><br><br>
					<label class="btn btn-default">
					<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="b">B
				</label><div class="col-md-7">
					<input type="text" id="b{{$q}}" name="b{{$q}}"  value="{{$quest->b}}" style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
				</div><br><br>
					<label class="btn btn-default">
					<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="c">C
				</label><div class="col-md-7">
					<input type="text" id="c{{$q}}" name="c{{$q}}" value="{{$quest->c}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
				</div><br><br>
					<label class="btn btn-default active">
					<input type="radio" name="ml{{$q}}" id="mul_option{{$q}}" value="d" checked="checked">D
				</label><div class="col-md-7">
					<input type="text" id="d{{$q}}" name="d{{$q}}" value="{{$quest->d}}"  style="background-color: #FFF;" class="form-control col-md-7 col-xs-12">
				</div>
				@endif
									</div>
									@if($q < count($questions))
									<a style="float:right" onclick="showonlyone('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
									@endif
									<a style="float:right" onclick="showonlyone('newboxes{{$q-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
								</div>
								</div>
							@else
							<div class="newboxes" id="newboxes{{$q}}" style="display:none">
										<div class="form-group">
								<h3>Identification/ Fill in the Blanks</h3>
								<label for="message">Question {{$q}} :</label>
								<textarea id="questIden{{$q}}" class="form-control" name="question[]" style="margin-bottom:10px;background-color: #FFF;">{{$quest->question}}</textarea>
										<label>Answer:</label>
										<div class="control-group">
											<div class="col-md-3 col-sm-3 col-xs-12" style="margin-left: -10px;" >
												<input type="text" id="tags_{{$q}}" onchange="doTag('{{$q}}')" class="tags form-control" name="iden{{$q}}" value="{{$quest->answers}}">
											</div>
										</div>
										@if($q < count($questions))
										<a style="float:right" onclick="showonlyone('newboxes{{$q+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
										@endif
										<a style="float:right" onclick="showonlyone('newboxes{{$q-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
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
  </div>
	<div class="modal fade bs-example-modal-sm" id="confirm-submit-question" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel2">Reminders</h4>
				</div>
				<div class="modal-body">
					<h4>Note:</h4>
					<table class="table table-hover">
						<tr>
							<th>
								Total Questions
							</th>
							<th>
								Filled Questions Correctly
							</th>
							<th>
								Remarks
							</th>
						</tr>
						<tr>
							<td>
								{{$true_false + $identification + $multiple_choice}}
							</td>
							<td id="filledQuestions">
							</td>
							<td id="remarks">
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" style="margin-top:1%" onclick="submitQuestion()">Proceed</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

@stop
