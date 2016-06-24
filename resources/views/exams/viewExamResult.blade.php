@extends('layouts.layout_professor')

@section('title')
	View Exam
@stop

@section('page-content')
<input type="hidden" id="title" value="Error">
<input type="hidden" id="message" value="You haven't created that exam!">
<input type="hidden" id="type" value="error">

<div class="right_col" role="main">
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
											<tr>
												<td>
													<b>{{$result->Name}}</b>
												</td>
													<td style="background-color:#67DE48;color:black">
														<b>{{$result->Score}}</b>
													</td>
												<td>
													{{$result->Total}}
												</td>
											</tr>
											<?php $passed++;?>
											@else
												<tr>
													<td>
  													<b>{{$result->Name}}</b>
  												</td>
  													<td style="background-color:#D02727;color:black">
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
