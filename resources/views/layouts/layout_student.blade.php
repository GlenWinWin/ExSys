<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/timer.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/icheck/flat/green.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/quiz.css')}}" rel="stylesheet">
    <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          setInterval(function () {
            $('#menu2').load("{{asset('notification')}}");
            $('#notificationCount').load("{{asset('count_notif')}}")
          }, 1000);
          $("#whenClick").click(function(){
            $('#updateNotif').load("{{asset('update_notification')}}");
          });
        });
    </script>
  </head>


  <body class="nav-md">

    <div class="container body">


      <div class="main_container">

        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            <div class="navbar nav_title" style="border: 0;">
              <a href="home" class="site_title"><i class="glyphicon glyphicon-book"></i> <span>CITE ExSys</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu prile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{ Auth::user()->profile_path }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu prile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                  <li><a href="home"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-group"></i> Groups </a>
                    <ul class="nav child_menu" style="display: none" >
                      {!! Form::open(array('action' => 'GroupController@viewGroupStudent' , 'method' => 'post' , 'id' => 'specificGroup'))!!}
                       <input type="hidden" name="groupId" id="specific_group_id">
                      {!! Form::close()!!}
                      @if(count($groups) > 0)
                        @foreach($groups as $group)
                           <li><a onclick="setHiddenSpecificId({{$group->group_id}})">{{$group->group_name}}</a></li>
                        @endforeach
                      @endif
                    </ul>
                 </li>
                 <li><a><i class="fa fa-bar-chart-o"></i>Check Progress</a>
                   <ul class="nav child_menu" style="display: none" >
                     {!! Form::open(array('action' => 'ProgressController@checkExamsProgress' , 'method' => 'post' , 'id' => 'checkExamsProgress'))!!}
                      <input type="hidden" name="groupId" id="specific_group_id">
                     {!! Form::close()!!}
                     @if(count($groups) > 0)
                       @foreach($groups as $group)
                          <li><a onclick="checkExamsProgress({{$group->group_id}})">{{$group->group_name}}</a></li>
                       @endforeach
                     @endif
                   </ul>
                 </li>
                  <li role="presentation" class="dropdown" id="thisIs">
                    <a class="dropdown-toggle info-number" id="whenClick" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-pencil-square-o" id="updateNotif"></i>
                      <span class="badge bg-red" id="notificationCount">
                      </span>
                      Exams
                    </a>
                    @if($notifs > 3)
                      <ul id="menu2" class="dropdown-menu list-unstyled msg_list" role="menu" style="height: 170px;overflow-y: auto;">
                    @elseif($notifs <= 3)
                      <ul id="menu2" class="dropdown-menu list-unstyled msg_list" role="menu">
                    @endif
                      </ul>
                  </li>

                  <li><a data-toggle="modal" data-target=".join_group"><i class="fa fa-plus"></i> Join Group </a>
                  </li>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::user()->profile_path }}" alt="">{{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;">  Profile</a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">Help</a>
                    </li>
                    <li><a href="logout" onclick=" return confirm('Are you sure you want to logout?')"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </li>
                  </ul>
                </li>
                <!-- <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-red">9</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" style="height: 220px;overflow-y: auto;">
                    <li>
                      <a href="#">
                        <span class="image">
                                          <img src="{{ URL::asset('assets/images/img.jpg') }}" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                                          <img src="{{ URL::asset('assets/images/img.jpg')}}" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                                          <img src="{{ URL::asset('assets/images/img.jpg')}}" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                                          <img src="{{ URL::asset('assets/images/img.jpg')}}" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a href="#">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->

              </ul>
            </nav>
          </div>
        </div>
        <div class="modal fade join_group" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Join a Group</h4>
                            </div>
                            <div class="modal-body">
                              {!! Form::open(array('action' => 'GroupController@joinGroup' , 'method' => 'post' , 'id' => 'formJoinGroup'))!!}
                              <label for="Group Name">Group Code: </label>
                              <input type="text" class="form-control" onkeyup="disable_ableButton()" id="valueCode" name="group_Code" placeholder="Group Code">
                              {!! Form::close()!!}
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:2%">Close</button>
                              <button type="button" class="btn btn-primary" id="submitbutton" onclick="submitJoinForm()">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
        <!--page-content here-->
        @yield('page-content')
      </div><!-- /main-container -->
    </div><!-- /container-body -->
    <script type="text/javascript">
    $(document).ready(function(){
      var groupCode = document.getElementById("valueCode").value;

      if(groupCode == null || groupCode == ""){
        document.getElementById('submitbutton').disabled = true;
      }
    });
    function disable_ableButton(){
      var groupCode = document.getElementById("valueCode").value;

      if(groupCode != null || groupCode != ""){
        if(groupCode.length < 7){
            document.getElementById('submitbutton').disabled = true;
        }
        else{
          document.getElementById('submitbutton').disabled = false;
        }
      }
    }
    function submitJoinForm(){
      $('#formJoinGroup').submit();
    }

    </script>
    <script src="{{ URL::asset('assets/js/specific_group.js')}}"></script>
            @yield('js_script')

  </body>
</html>
