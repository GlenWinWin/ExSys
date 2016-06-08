@extends('layouts.layout_professor')

@section('title')
	Groups
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
              <h3>Manage Groups</h3>
            </div>


          </div>

          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="height:600px;">
                <div class="x_title">
                  <h2>Create group</h2>

                  <div class="clearfix"></div>
                </div>

                <!--content here-->

                <div class="x_title">
                  {!! Form::open(array('action' => 'GroupController@createGroup' , 'method' => 'post' , 'id' => 'createGroupForm'))!!}

                <label for="exam">Group Name: </label>
                <input type="hidden" name="groupCode" id="group_Code" value="">
                <input type="text" id="group_name" onkeyup="ableAddGroupButton()" class="form-control" name="group_name" placeholder="Group Name | Section | Class ">
                {!! Form::close()!!}
                </br>
								{!! Form::open(array('action' => 'GroupController@viewGroup' , 'method' => 'post' , 'id' => 'specificGroup'))!!}
								 <input type="hidden" name="groupId" id="specific_group_id">
								{!! Form::close()!!}
								

<!-- Small modal -->

              <button type="button" class="btn btn-primary" id="addButtonGroup" onclick="setValue()" data-toggle="modal" data-target=".generate_group_code">Submit</button>

              <div class="modal fade generate_group_code" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel2">Click Proceed</h4>
                    </div>
                    <div class="modal-body">
                      <h5>Group Code: </h5><h4 style="color:red;" id="groupCode"></h4>
											<button type="button" name="button" title="Click the button to change the group code if you want" onclick="setValue()"><i class="fa fa-share-square"></i></button>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" style="margin-top:2%" data-dismiss="modal">Close</button>
                      <button type="button" onclick="submitCreateGroupForm()" class="btn btn-primary">Proceed</button>
                    </div>
                  </div>
                </div>
              </div>

              </div>
              </br>
              <!--End of Generate Group Code-->

<!-- modal for checking details -->
<div class="modal fade modify_group" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel2">Modify this Group</h4>
                    </div>
                    <div class="modal-body">
                      <label for="Group Name">Group Name: </label>
                      <input type="text" id="group_name_modal" class="form-control" name="group_nameModal" placeholder="">
                      <label for="Group Details">Group Details(Optional): </label>
                      <input type="text" id="group_details" class="form-control" name="group_details" placeholder="">

                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:2%">Close</button>
                      <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
<!-- end -->

<!-- Delete Group Modal -->
<div class="modal fade delete_group" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel2">Delete this Group</h4>
                    </div>
                    <div class="modal-body">
											{!! Form::open(array('action' => 'GroupController@deleteGroup' , 'method' => 'post' , 'id' => 'deleteGroupForm'))!!}
                      <p>Please take note that this will result to permanently deleting this group. </p>
											<input type="hidden" name="groupId" id="idGroup" >
											<input type="hidden" name="deletedGroupName" id="deletedGroupName" >
											{!! Form::close()!!}
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:2%">No</button>
                      <button type="button" class="btn btn-danger" onclick="submitDeleteGroupForm()">Yes</button>
                    </div>
                  </div>
                </div>
              </div>

<!-- End -->
              </br>
							@if(count($groups) > 0)
               <table class="table">
                  <thead>
                    <tr>
                      <th>Group Code</th>
                      <th>Group Name</th>
                      <th>View Members</th>
                      <th>Modify</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($groups as $group_list)
                    <tr>
                      <th scope="row">{{$group_list->group_passCode}}</th>
                      <td>{{$group_list->group_name}}</td>
                      <td><a onclick="setHiddenSpecificId({{$group_list->group_id}})" id="viewMembers">View Members</a></td>
                      <td><button type="button" class="btn btn-info" data-toggle="modal" data-target=".modify_group"><i class="fa fa-edit"></i> Modify</button></td>
                      <td><button  onclick="setId({{$group_list->group_id}},'{{$group_list->group_name}}')" type="button" class="btn btn-warning" data-toggle="modal" data-target=".delete_group"><i class="fa fa-trash"></i> Delete</button></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
							@endif
    </div>
    <footer>
      <div class="pull-right">
        CITE Examination System
      </div>
      <div class="clearfix"></div>
    </footer>
  </div>
</div>
</div>
</div>

@stop


@section('js_script')

<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/custom.js')}}"></script>
<script src="{{ URL::asset('assets/js/formField.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
  var groupName = document.getElementById("group_name").value;

  if(groupName == null || groupName == ""){
    document.getElementById('addButtonGroup').disabled = true;
  }
	$("#viewAlert").fadeTo(3000, 500).fadeOut(500, function(){
	});
});
</script>
@stop
