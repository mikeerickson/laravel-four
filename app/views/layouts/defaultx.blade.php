<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{ $title }}</title>
	<meta name="viewport" content="width=device-width">

	{{ HTML::script('/js/jquery-1.8.0.js') }}
	{{ HTML::script('/js/utils.js') }}
	{{ HTML::script('/js/laravel.js') }}

	{{ HTML::style('/css/normalize.css') }}	

	{{ HTML::style('/css/bootstrap.css') }}
	{{ HTML::script('/js/bootstrap.js') }}

	{{ HTML::style('/css/bootstrap-select.css') }}
	{{ HTML::script('/js/bootstrap-select.js') }}

	{{ HTML::style('/css/default.css') }}

	{{ HTML::style('/js/msgbox/jquery.msgbox.css') }}
	{{ HTML::script('/js/msgbox/jquery.msgbox.min.js') }}
	
	<style>
		select { width: 175px; }		
	</style>
	
	<script>

		$(function(){		
			$("#msg_close").click(function() {
				$("#message").slideUp(200);
	  		});
	  			
		});

	    function msgboxConfirm(msg) {
	    
	    	var btnCancel = "Cancel";
	    	var btnSubmit = "Delete";
	    	
	    	$.msgbox(msg, 
	    		{	type: "confirm", 
	    			buttons: [
		    				{type:"cancel", value: btnCancel },
		    				{type:"submit", value: btnSubmit }
	    				]
	    		}, function(result) {
	    			bRet = result == btnSubmit ? true : false;
	    			alert(bRet);
	    			return bRet;
		    });
	    	
	    	
	    }

	</script>
		
</head>

<body id="body" onload='formFocus();'>

	<div class="wrapper">
		<div id="userinfo">				
			@if ( Auth::check() )
				Welcome back <strong>{{ Cookie::get('username') }}</strong>&nbsp;&nbsp;
				<i class="icon-user"></i>&nbsp;{{ HTML::link('logout', 'Logout') }}
			@endif	
		</div>
		
		<header>
			<h1>{{ $header }}</h1>
		</header>

		<div id="message">
			<p>
				@yield('validation')
			</p>
		</div>
		
		<div role="main" class="main">
			<div class="home">
				@yield('content')		
			</div>
		</div>	

		<footer>
	        Rendered On: {{ Helpers::currentTime() }} 
		</footer>

	</div>

</body>

    <script type="text/javascript">
      window.onload=function(){
      $('select').selectpicker();
      };
    </script>   


</html>