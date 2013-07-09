<!DOCTYPE html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{ $title }}</title>
	<meta name="viewport" content="width=device-width">


	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: JS Libraries -->
	<script type="text/javascript" src="/js/vendor/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="/js/vendor/angular-1.0.6-min.js"></script>
	<script type="text/javascript" src="/js/vendor/utils.js"></script>
	<script type="text/javascript" src="/js/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="/js/vendor/msgbox/jquery.msgbox.min.js"></script>
	<script type="text/javascript" src="/js/vendor/humane.js"></script>
 	<script type="text/javascript" src="/js/vendor/parsley.min.js"></script>
 	<script type="text/javascript" src="/js/vendor/moment.js"></script>
	<script type="text/javascript" src="/js/vendor/underscore-1.5.min.js"></script>
	<script type="text/javascript" src="/js/vendor/bootstrapSwitch.js"></script>
	<script type="text/javascript" src="/js/vendor/select2.js"></script>

	<!-- start: CSS -->
	<link rel="stylesheet" href="/css/default.css" />
	<link rel="stylesheet" href="/js/vendor/msgbox/jquery.msgbox.css" />
	<link rel="stylesheet" href="/css/vendor/original.css" />
	<link rel="stylesheet" href="/css/vendor/bootstrap.min.css" id="bootstrap-style" />
	<link rel="stylesheet" href="/css/vendor/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="/css/vendor/style.css" id="base-style" />
	<link rel="stylesheet" href="/css/vendor/style-responsive.css" id="base-style-responsive" />
	<link rel="stylesheet" href="/css/vendor/bootstrapSwitch.css" />
	<link rel="stylesheet" href="/css/vendor/select2.css" />
	<!-- end: CSS -->


	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->

	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->


	<link rel="stylesheet" href="/css/validation.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="/css/app.css" type="text/css" media="screen" charset="utf-8">

	<!-- Start Application Script -->
	<script src="/js/main.js"></script>

</head>

<body id="body">

	<div class="wrapper">
		<div id="userinfo">
			@if ( Auth::check() )
				Welcome back <strong>{{ ucwords(Auth::user()->username) }}</strong>&nbsp;&nbsp;
				<i class="icon-user"></i>&nbsp;{{ link_to('logout', 'Logout') }}
			@else
				<a href="/login">Login</a>
			@endif
		</div>

		<header>
			<h1>{{ $title }}</h1>
		</header>

		<nav>
			<ul ul class="nav nav-tabs">
			  <li class="{{ $title == 'Home' ? 'active' : '' }}"><a href="/">Home</a></li>
			  <li class="{{ $title == 'Companies' ? 'active' : '' }}"><a href="/companies">Companies</a></li>
			  <li class="{{ $title == 'Contacts' ? 'active' : '' }}"><a href="/contacts">Contacts</a></li>
			  <li class="{{ $title == 'Users' ? 'active' : '' }}"><a href="/users">Users</a></li>
			  <li class="{{ $title == 'Players' ? 'active' : '' }}"><a href="/players">Players</a></li>
			</ul>
		</nav>

		<div id="msgAlert" class="alert" style="display: none;">
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<h4 id="msgHdr"></h4>
			<div id="msgBody"> </div>
		</div>

		<div role="main" class="main">
			<div class="home">
				@yield('content')
			</div>
		</div>

		<div id="footer">
	        Rendered On: {{ Helpers::currentTime() }}
		</div>

	</div>

	<script src="/js/laravel.js"></script>

	<script>
	  @if (!is_null(Session::get('message')))

	  		$msg = '{{ Session::get('message') }}';
	  		var msgObj = eval("(" + $msg + ')');

			$("#msgAlert").show();

			$msgClass = msgObj.msgType;
			$msgHdr   = msgObj.msgHdr;
			$msgBody  = msgObj.msgBody;


			$msgClass != "" ? $("#msgAlert").addClass($msgClass) : $("#msgAlert").addClass('alert-block');
			$msgHdr != "" ? $("#msgHdr").html($msgHdr) : '';

			$("#msgBody").html($msgBody);

		@endif

	</script>


</body>

</html>