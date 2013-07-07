<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{ $title }}</title>
	<meta name="viewport" content="width=device-width">


	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: JS -->
	<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="/js/utils.js"></script>
	<script type="text/javascript" src="/js/bootstrap.js"></script>
	<script type="text/javascript" src="/js/msgbox/jquery.msgbox.min.js"></script>
	<script type="text/javascript" src="/js/humane.js"></script>
	<script type="text/javascript" src="/js/angular-1.0.6-min.js"></script>
 	<script type="text/javascript" src="/js/parsley.min.js"></script>
 	<script type="text/javascript" src="/js/moment.js"></script>
	<script type="text/javascript" src="/js/main.js"></script>
	<script type="text/javascript" src="/js/underscore-1.5.min.js"></script>
	<script type="text/javascript" src="/js/bootstrapSwitch.js"></script>
	<script type="text/javascript" src="/js/select2.js"></script>

	<!-- start: CSS -->
	<link rel="stylesheet" href="/css/default.css" />
	<link rel="stylesheet" href="/js/msgbox/jquery.msgbox.css" />
	<link rel="stylesheet" href="/css/original.css" />
	<link rel="stylesheet" href="/css/bootstrap.min.css" id="bootstrap-style" />
	<link rel="stylesheet" href="/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="/css/style.css" id="base-style" />
	<link rel="stylesheet" href="/css/style-responsive.css" id="base-style-responsive" />
	<link rel="stylesheet" href="/css/bootstrapSwitch.css" />
	<link rel="stylesheet" href="/css/select2.css" />
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

	<link rel="stylesheet" href="/css/bootstrap-select.css" />
	<script src="/js/bootstrap-select.js"></script>

	<link rel="stylesheet" href="/css/validation.css" type="text/css" media="screen" charset="utf-8">

	<style>
		select { width: 215px; }
		.dropdown-menu { background-color: black; color: green; border: 0px;}
		footer {
			background-color: white;
			font-size: 11px;
			margin: 40px 10px 5px 10px;
			border-top: 1px solid #606060;
			color: #606060;
			text-align: left;
		}
		body { margin-top: 20px; font-size: 12px;}
		#msgHdr { padding-bottom: 5px;}
	</style>

	<script>
		$(function() {
			console.log('Moment JS Date: '+moment().format('MMMM Do YYYY, h:mm:ss a'));
			console.log(moment().subtract('seconds', 32).fromNow());

			$('select').select2();
/* 			alert(jQuery.fn.jquery); */

			// dont move this into main.js, needs to stay here ot work
			$('#contact').parsley( {listeners: {
			    onFormSubmit: function ( isFormValid, event ) {
			        if ( !isFormValid  ) {
						$("#msgAlert").show();
						$("#msgAlert").addClass('alert-error');
						$("#msgHdr").html("Validation Error");
						$("#msgBody").html("You have errors in your form, pleaes correct and try again.");
			        }
			    }
			}});

		});
	</script>

</head>

<body id="body">

	<div class="wrapper">
		<div id="userinfo">
			@if ( Auth::check() )
				Welcome back <strong>{{ Cookie::get('username') }}</strong>&nbsp;&nbsp;
				<i class="icon-user"></i>&nbsp;{{ link_to('logout', 'Logout') }}
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