<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
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
            $('#menu1').load("{{asset('notification')}}");
            $('#notification_count').load("{{asset('count_notif')}}")
          }, 1000);
          $("#whenHover").click(function(){
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

                  <li>
                    <a><i class="fa fa-area-chart"></i> Progress </a>
                      <ul class="nav child_menu" style="display: none" >
                        {!! Form::open(array('action' => 'ProgressController@viewProgress' , 'method' => 'get' , 'id' => 'showProgress'))!!}
                         <input type="hidden" name="groupId" id="specific_group_id">
                        {!! Form::close()!!}
                        @foreach($groups as $group)
                           <li><a onclick="showProgress({{$group->group_id}})">{{$group->group_name}}</a></li>
                        @endforeach
                      </ul>
                  </li>

                   <li><a><i class="fa fa-group"></i> Groups </a>
                     <ul class="nav child_menu" style="display: none" >
                       {!! Form::open(array('action' => 'GroupController@viewGroup' , 'method' => 'post' , 'id' => 'specificGroup'))!!}
                        <input type="hidden" name="groupId" id="specific_group_id">
                       {!! Form::close()!!}
                       @foreach($groups as $group)
                          <li><a onclick="setHiddenSpecificId({{$group->group_id}})">{{$group->group_name}}</a></li>
                       @endforeach
                     </ul>
                  </li>

                  <li><a href="groups"><i class="fa fa-cog"></i> Manage Groups </a>
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
                <li role="presentation" class="dropdown">
                  <a class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" id="whenHover">
                    <i class="fa fa-envelope-o" id="updateNotif"></i>
                    <span class="badge bg-red" id="notification_count"></span>
                  </a>
                  @if($notifs > 3)
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" style="height: 170px;overflow-y: auto;">
                  @elseif($notifs <= 3)
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  @endif
                    </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!--page-content here-->
        @yield('page-content')
      </div><!-- /main-container -->
    </div><!-- /container-body -->
    <script src="{{ URL::asset('assets/js/specific_group.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/icheck/icheck.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/each.js')}}"></script>
    <script src="{{ URL::asset('assets/js/custom.js')}}"></script>
    <script src="{{ URL::asset('assets/js/tags/jquery.tagsinput.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/takeExam.js')}}"></script>
    <script src="{{ URL::asset('assets/js/timer.js')}}"></script>
    <script src="{{ URL::asset('assets/js/chartjs/chart.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/chartjs/viewPassorFail.js')}}"></script>
    <script src="{{ URL::asset('assets/js/formField.js')}}"></script>
    <script src="{{ URL::asset('assets/js/progressbar/bootstrap-progressbar.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pace/pace.min.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    	var examName = document.getElementById("examName").value;
    	var numberOfItems = +document.getElementById("numberOfItems").value;

    	if((examName == null || examName == "") && (numberOfItems == null || numberOfItems == "")){
    		document.getElementById('btnSubmit').disabled = true;
    	}
      var groupName = document.getElementById("group_name").value;

      if(groupName == null || groupName == ""){
        document.getElementById('addButtonGroup').disabled = true;
      }
    	$("#viewAlert").fadeTo(3000, 500).fadeOut(500, function(){
    	});
    	$(".showQuestion").hide();
    		var rem = $('#reminders');
    		rem.modal();
    });
    </script>

  </body>
</html>
