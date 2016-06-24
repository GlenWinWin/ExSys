@extends('layouts.layout_professor')

@section('title')
	Create Exam Here
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
        <h3>Create Exam</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="height:700px;">
          <div class="x_title">
            <h2>Create an exam with just few easy steps.</h2>
            <div class="clearfix"></div>
          </div>
          {!! Form::open(array('route' => 'exam.store','id' => 'formField'))!!}
					<input type="hidden" name="groupId" value="{{$groupId}}">
					<label for="exam">Exam Name: </label>
          <input type="text" id="examName" class="form-control" name="examName" onkeyup="stoppedTyping()" placeholder="Specify the name of this exam, you can reuse this exam for the next generation to come.">

          <label for="numberOfItems">Number of Items: </label>
          <input type="number" id="numberOfItems" class="form-control" name="numberOfItems"  onkeyup="stoppedTyping()" oninput="createChart()" placeholder="Enter the total number of items here">

          <h4>Types of Exam</h4>

          <label for="typeOfExam1">True or False:  </label>
          <input type="number" id="typeOfExam1" class="form-control" name="typeOfExam1" onkeyup="stoppedTyping()" oninput="createChart()" placeholder="Enter number of items here">

          <label for="typeOfExam2">Multiple Choice: </label>
          <input type="number" id="typeOfExam2" class="form-control" name="typeOfExam2" onkeyup="stoppedTyping()" oninput="createChart()" placeholder="Enter number of items here">

          <label for="typeOfExam3">Identification or Fill in the Blanks: </label>
          <input type="number" id="typeOfExam3" class="form-control" name="typeOfExam3" onkeyup="stoppedTyping()" oninput="createChart()" placeholder="Enter number of items here">
          </br>
          <button type="button" class="btn btn-primary" data-toggle="modal" id="btnSubmit" data-target="#confirm-submit">Submit</button>
          {!! Form::close()!!}
          <center>
          <div class="x_panel" style="width:40%;border-color:white;">
            <canvas id="canvasDoughnut" border="none"></canvas>
          </div>
          </center>
                <div class="modal fade bs-example-modal-sm" id="confirm-submit" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Reminders</h4>
                      </div>
                      <div class="modal-body">
                        <h4>Note:</h4>
                        <p>This is a reminder for you. Double check the number of items and if your are already sure and decided you can click continue to start filling up your questions. Have a great day! </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="margin-top:1%" onclick="clickButton()">Proceed</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            CITE Examination System
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
  </div>
</div>
</div>
@stop
