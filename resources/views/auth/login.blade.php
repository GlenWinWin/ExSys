<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Page!</title>
	<link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/custom.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/green.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
</head>
<body style="background:#F7F7F7">
	@if( (Session::has('flash_message')) && (Session::get('flash_message') != 'has-error') )
    <div class="alert alert-{{ Session::get('type_message') }} alert-dismissible fade in" id="viewAlert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>{{ strtoupper(Session::get('type_message') == 'danger' ? 'error' : Session::get('type_message')) }} : </strong> {!! Session::get('flash_message') !!}
    </div>
	@endif
<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          {!! Form::open(array('route' => 'users.store'))!!}
            <h1>Login Form</h1>
            <div>
              <input type="email" class="form-control" name="email" placeholder="Email" required="" />
            </div>
            <div>
              <input type="password" class="form-control" name="password" placeholder="Password" required="" />
            </div>
            <div>
              <button class="btn btn-default submit">Log in</button>
              <a class="reset_pass" href="#">Lost your password?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">New to site?
                <a href="#toregister" class="to_register"> Create Account </a>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><!-- <i class="fa fa-paw" style="font-size: 26px;"> --></i>CITE Examination System</h1>

                <p>©2016 All Rights Reserved</p>
              </div>
            </div>
          {!! Form::close()!!}
          <!-- form -->
        </section>
        <!-- content -->
      </div>
      <div id="register" class="animate form">
        <section class="login_content">
          <form>
            <h1>Create Account</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <button class="btn btn-default submit">Submit</button>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">Already a member ?
                <a href="#tologin" class="to_register"> Log in </a>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="glyphicon glyphicon-book"></i> CITE Examination System</h1>

                <p>©2016 All Rights Reserved</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>
	<script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
	</body>
	</html>

	<script type="text/javascript">
	$(document).ready(function(){
		$("#viewAlert").fadeTo(3000, 500).fadeOut(500, function(){
		});
	});
	</script>
