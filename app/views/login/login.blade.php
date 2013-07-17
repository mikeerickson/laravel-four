<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bootstrap Login</title>
	<link href="css/vendor/bootstrap.css" rel="stylesheet" type="text/css" />
	<script src="js/vendor/jquery-1.9.1.min.js"></script>
	<script src="js/vendor/bootstrap-modal.js"></script>

    <!-- http://jsfiddle.net/guyong/EUVWC/2/ -->

    <script>
        $(function() {
            var login = $('#login_dlog');
            login.modal({ backdrop: true, keyboard: true, show: true });

            // TODO: Implement Remember Me

            // $("body").css("display", "none");
            // $("body").fadeIn(1000);

            $('#login_forget').click(function(){
                // TODO: Create password reset email
                // TODO: Determine how to create a unique random URL
                // TODO: Create reset password page
                // TODO: When password reset, update table within new password (using users email address)
                alert('send reset password');
            });
            $('#btn_cancel').click(function(){
                // $("body").fadeOut(1000);
                window.location.href = '/';
            });
        });
    </script>

    <style>
        #msgBox { margin: 10px; }
    </style>

</head>
<body>

<div id="login_dlog" class="modal hide">
    <div class="modal-header">
         <!-- <a href="#" class="close" data-dismiss="modal">×</a> -->
         <h3>Login</h3>
    </div>

        @if($errMsg != '')
            <div id="msgBox">
                <div class="alert alert-error">
                    {{ $errMsg }}
                </div>
            </div>
        @endif

        {{ Form::open(['id' => 'login', 'method'  => 'post']) }}

            <div class="modal-body">
                {{ Form::label('login_id','User ID or E-Mail Address' ) }}
                {{ Form::text ('login_id', $userID ) }}

                {{ Form::label('login_pw','Password') }}
                {{ Form::password ('login_pw') }}

                <label class="checkbox">
                    {{ Form::checkbox('login_remember', '1', $remember ) }} Remember Me
                </label>
                <p style="margin: 20px;">
                    <a href="#" id="login_forget">Forgot Password</a>
                </p>
            </div>

            <div id="toolbar">
                <div class="pull-right" style="margin: 20px;">
                    <a href="#" id="btn_cancel" class="btn" data-dismiss="modal">Cancel</a>
                    {{ Form::submit('Login',['class' => 'btn btn-primary']) }}
                </div>
            </div>
       {{ Form::close() }}
</div>

</body>
</html>