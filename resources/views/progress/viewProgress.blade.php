@extends('layouts.layout_professor')

@section('title')
	View Progress
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
        <h3>View Progress</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
				<center>
					<table class="table table-hover table-bordered" id="tableStudentProgress">
						<thead>
							<tr>
								<th class="picture_progress">

								</th>
								<th>
									Name
								</th>
								<th>
									Average
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($members as $member)
								<tr>
									<td class="picture_progress"	>
										<center>
											<img src="{{$member->Pic}}" alt="Picture" width="100px" height="100px">
										</center>
									</td>
									<td>
										{{$member->Name}}
									</td>
									<td>
										{{$member->Average}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</center>
    	</div>
  	</div>
	</div>
</div>

@stop

@section('js_script')
<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/custom.js')}}"></script>
<script src="{{ URL::asset('assets/js/tags/jquery.tagsinput.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#viewAlert").fadeTo(3000, 500).fadeOut(500, function(){
	});
});
</script>
@stop
