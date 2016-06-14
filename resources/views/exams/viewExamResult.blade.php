@extends('layouts.layout_professor')

@section('title')
	View Exam
@stop

@section('page-content')

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
        <h3>Exam Results</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="container" style="{{count($examResults) > 7 ? 'height: 280px;overflow-y: auto;' : ''}}float:left;width:49%">
				<div class="row" id="viewResult">
														 	<?php $passed=0;
															$failed=0;?>
		        <table class="table table-hover table-bordered" id="viewResultExamTable">
							<thead>
								<tr>
										<th>
		                Student Name
		              	</th>
		              <th>
		                Score
		              </th>
									<th>
		                Total
		              </th>
		            </tr>
							</thead>
							<tbody>
								<!-- failed #FF4949 -->
								<!-- sabit #FFEF49-->
		            @foreach($examResults as $result)
									@if($result->taken == '0')
										<tr>
											<td>
												{{$result->Name}}
				              </td>
												<td>
													{{$result->Score}}
					              </td>
											<td>
												{{$result->Total}}
											</td>
										</tr>
									 @else
									 	@if($result->Percentage >= 75)
											<tr style="background-color:#67DE48;color:black">
												<td>
													<b>{{$result->Name}}</b>
												</td>
													<td>
														<b>{{$result->Score}}</b>
													</td>
												<td>
													{{$result->Total}}
												</td>
											</tr>
											<?php $passed++;?>
											@else
												<tr style="background-color:#D02727;color:black">
													<td>
  													<b>{{$result->Name}}</b>
  												</td>
  													<td>
  														<b>{{$result->Score}}</b>
  													</td>
												 <td>
													 {{$result->Total}}
												 </td>
											 </tr>
											 <?php $failed++;?>
										@endif
									@endif
								@endforeach
		          </tbody>
		        </table>
						<input type="hidden" id="passedStudents" value="{{$passed}}">
						<input type="hidden" id="failedStudents" value="{{$failed}}">
		  	</div>
    </div>
		<div class="x_panel" style="width:50%;float:rigth;margin-left:1%;background-color:#F7F7F7;border:none">
			<canvas id="canvasDoughnut" border="none">
			</canvas>
		</div>
</div>

@stop

@section('js_script')
<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/custom.js')}}"></script>
<script src="{{ URL::asset('assets/js/chartjs/chart.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/chartjs/viewPassorFail.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#viewAlert").fadeTo(3000, 500).fadeOut(500, function(){
	});
});
</script>
@stop
