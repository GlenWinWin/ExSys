@extends('layouts.layout_professor')

@section('title')
	Add Question Here
@stop

@section('page-content')

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Examination Maker</h3>
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
							<input name="timeLimit" type="number" min="1" max="1440" id="time_limit" required="required" value="1" class="form-control col-md-2 col-xs-12">
							Minutes
					</div>
					<div class="col-md-2">
						<ul class="to_do">
							<li>
								<p>
									<input type="checkbox" class="flat" name="check_random" value="1"> Random Questions
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

<button type="button" class="btn btn-primary" data-toggle="modal"
data-target="#confirm-submit-question" onclick="displayModal({{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" style="float:right;">Done</button>                      <div class="clearfix"></div>
					</div>
					<div class="numques">
						<h2>Questions</h2><br>
						@for($i = 1;$i <= $numberOfItems;$i++)
									<a  id="myHeader{{$i}}" onclick="showonlyone('newboxes{{$i}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})">
										{{$i}}
									</a>
						@endfor
					</div>
					<?php $t_f=0;?>
					@if($true_false > 0)
					@for($t_f = 1;$t_f <= $true_false;$t_f++)
					@if($t_f == 1)
					<div class="newboxes" id="newboxes{{$t_f}}">
					<div class="form-group">
						<h3> True or False</h3>
						<label for="message">Question {{$t_f}}:</label>
						<textarea id="question_tf{{$t_f}}" required="required" class="form-control" name="true_false_question[]" data-parsley-trigger="keyup"
							data-parsley-validation-threshold="10" style="margin-bottom:10px;"></textarea>

																										<label>Answer:</label>
																										<br>
																										<div class="btn-group" data-toggle="buttons" >
																											<label class="btn btn-default">
																												<input type="radio" name="tf{{$t_f}}" id="tf_option{{$t_f}}" value="true"> True
																											</label>

																											<label class="btn btn-default">
																												<input type="radio" name="tf{{$t_f}}" id="tf_option{{$t_f}}" value="false"> False
																											</label>

																										</div>
																										<a style="float:right" onclick="showonlyone('newboxes{{$t_f+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
						</div>
						</div>
						@else
						<div class="newboxes" id="newboxes{{$t_f}}" style="display:none">
						<div class="form-group">
							<h3> True or False</h3>
							<label for="message">Question {{$t_f}}:</label>
							<textarea id="question_tf{{$t_f}}" required="required" class="form-control" name="true_false_question[]" data-parsley-trigger="keyup"
								data-parsley-validation-threshold="10" style="margin-bottom:10px;"></textarea>

																											<label>Answer:</label>
																											<br>
																											<div class="btn-group" data-toggle="buttons" >
																												<label class="btn btn-default">
																													<input type="radio" name="tf{{$t_f}}" id="tf_option{{$t_f}}" value="true"> True
																												</label>

																												<label class="btn btn-default">
																													<input type="radio" name="tf{{$t_f}}" id="tf_option{{$t_f}}" value="false"> False
																												</label>

																											</div>
																											@if($t_f < $numberOfItems)
																											<a style="float:right" onclick="showonlyone('newboxes{{$t_f+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
																											@endif
																											<a style="float:right" onclick="showonlyone('newboxes{{$t_f-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
							</div>
							</div>
							@endif
						@endfor
						@endif
						<?php $multi=0;?>
						@if($multiple_choice > 0)
						@for($multi = $true_false+1;$multi <= ($true_false + $multiple_choice);$multi++)
						@if($multi == 1)
						<div  class="newboxes" id="newboxes{{$multi}}">
						<div class="form-group">
							<h3> Multiple Choice</h3>
							<label for="message">Question {{$multi}} :</label>
							<textarea id="question_mul{{$multi}}" required="required" class="form-control" name="mulQuestion[]" style="margin-bottom:10px;"></textarea>
									<label>Answer:</label>
<br>
									<div class="btn-group" data-toggle="buttons" >
									<label class="btn btn-default">
								<input type="radio" name="ml{{$multi}}" id="mul_option{{$multi}}" value="a"> A
							</label><div class="col-md-7">
								<input type="text" id="a{{$multi}}" required="required" name="a{{$multi}}" class="form-control col-md-7 col-xs-12">
							</div><br><br>
								<label class="btn btn-default">
								<input type="radio" name="ml{{$multi}}" id="mul_option{{$multi}}" value="b"> B
							</label><div class="col-md-7">
								<input type="text" id="b{{$multi}}" required="required" name="b{{$multi}}" class="form-control col-md-7 col-xs-12">
							</div><br><br>
								<label class="btn btn-default">
								<input type="radio" name="ml{{$multi}}" id="mul_option{{$multi}}" value="c"> C
							</label><div class="col-md-7">
								<input type="text" id="c{{$multi}}" required="required" name="c{{$multi}}" class="form-control col-md-7 col-xs-12">
							</div><br><br>
								<label class="btn btn-default">
								<input type="radio" name="ml{{$multi}}" id="mul_option{{$multi}}" value="d"> D
							</label><div class="col-md-7">
								<input type="text" id="d{{$multi}}" required="required" name="d{{$multi}}" class="form-control col-md-7 col-xs-12">
							</div>
								</div>
								<a style="float:right" onclick="showonlyone('newboxes{{$multi+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>

							</div>
							</div>
							@else
							<div  class="newboxes" id="newboxes{{$multi}}" style="display:none">
							<div class="form-group">
								<h3> Multiple Choice</h3>
								<label for="message">Question {{$multi}} :</label>
								<textarea id="question_mul{{$multi}}" required="required" class="form-control" name="mulQuestion[]" style="margin-bottom:10px;"></textarea>
										<label>Answer:</label>
	<br>
										<div class="btn-group" data-toggle="buttons" >
										<label class="btn btn-default">
									<input type="radio" name="ml{{$multi}}" id="mul_option{{$multi}}" value="a"> A
								</label><div class="col-md-7">
									<input type="text" id="a{{$multi}}" required="required" name="a{{$multi}}" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$multi}}" id="mul_option{{$multi}}" value="b"> B
								</label><div class="col-md-7">
									<input type="text" id="b{{$multi}}" required="required" name="b{{$multi}}" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$multi}}" id="mul_option{{$multi}}" value="c"> C
								</label><div class="col-md-7">
									<input type="text" id="c{{$multi}}" required="required" name="c{{$multi}}" class="form-control col-md-7 col-xs-12">
								</div><br><br>
									<label class="btn btn-default">
									<input type="radio" name="ml{{$multi}}" id="mul_option{{$multi}}" value="d"> D
								</label><div class="col-md-7">
									<input type="text" id="d{{$multi}}" required="required" name="d{{$multi}}" class="form-control col-md-7 col-xs-12">
								</div>
									</div>
									@if($multi < $numberOfItems)
									<a style="float:right" onclick="showonlyone('newboxes{{$multi+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
									@endif
									<a style="float:right" onclick="showonlyone('newboxes{{$multi-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
								</div>
								</div>
								@endif
							@endfor
							@endif

							@for($iden = $multiple_choice+$true_false+1;$iden <= ($true_false+$identification + $multiple_choice);$iden++)
							@if($iden == 1)
											<div class="newboxes" id="newboxes{{$iden}}">
														<div class="form-group">
												<h3>Identification/ Fill in the Blanks</h3>
												<label for="message">Question {{$iden}} :</label>
												<textarea id="questIden{{$iden}}" required="required" class="form-control" name="iden_question[]" data-parsley-trigger="keyup"
													data-parsley-validation-threshold="10" style="margin-bottom:10px; " value="aa"></textarea>
														<label>Answers:</label>
														<div class="control-group">
															<div class="col-md-3 col-sm-3 col-xs-12" style="margin-left: -10px;" >
																<input id="tags_{{$iden}}" onchange="doTag('{{$iden}}')" type="text" class="tags form-control" name="iden{{$iden}}" placeholder="Answer"/>
															</div>
														</div>
														<a style="float:right" onclick="showonlyone('newboxes{{$iden+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
											</div>
								@else
								<div class="newboxes" id="newboxes{{$iden}}" style="display:none">
											<div class="form-group">
									<h3>Identification/ Fill in the Blanks</h3>
									<label for="message">Question {{$iden}} :</label>
									<textarea id="questIden{{$iden}}" required="required" class="form-control" name="iden_question[]" data-parsley-trigger="keyup"
										data-parsley-validation-threshold="10" style="margin-bottom:10px; "></textarea>
											<label>Answers:</label>
											<div class="control-group">
												<div class="col-md-3 col-sm-3 col-xs-12" style="margin-left: -10px;" >
													<input id="tags_{{$iden}}" type="text" onchange="doTag('{{$iden}}')" class="tags form-control" name="iden{{$iden}}" placeholder="Answer"/>
												</div>
												@if($iden < $numberOfItems)
												<a style="float:right" onclick="showonlyone('newboxes{{$iden+1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-primary btn-round"><i class="fa fa-arrow-circle-right"></i> </a>
												@endif
												<a style="float:right" onclick="showonlyone('newboxes{{$iden-1}}',{{$true_false > 0 ? $true_false : 0}},{{$multiple_choice > 0 ? $multiple_choice : 0}},{{$identification > 0 ? $identification : 0}})" class="btn btn-success btn-round"><i class="fa fa-arrow-circle-left"></i>  </a>
											</div>
											</div>
								</div>
								@endif
							@endfor
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
								{{$true_false+$identification + $multiple_choice}}
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
