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
	<script type="text/javascript" src="/lib/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="/lib/jquery-ui-1.10.0.custom.min.js"></script>
	<script type="text/javascript" src="/lib/angular-1.0.7-min.js"></script>
	<script type="text/javascript" src="/lib/utils.js"></script>
	<script type="text/javascript" src="/lib/bootstrap.js"></script>
	<script type="text/javascript" src="/lib/humane.js"></script>
 	<script type="text/javascript" src="/lib/parsley.min.js"></script>
 	<script type="text/javascript" src="/lib/moment.js"></script>
	<script type="text/javascript" src="/lib/underscore-1.5.min.js"></script>
	<script type="text/javascript" src="/lib/bootstrapSwitch.js"></script>
	<script type="text/javascript" src="/lib/chosen.js"></script>
	<script type="text/javascript" src="/lib/bootbox.min.js"></script>
	<script type="text/javascript" src="/lib/fullcalendar.min.js"></script>
	<script type="text/javascript" src="/lib/jquery.gravatar.js"></script>
	<script type="text/javascript" src="/lib/md5.js"></script>

	<link rel="stylesheet" href="/css/vendor/bootstrap.min.css" id="bootstrap-style" />
	<link rel="stylesheet" href="/css/vendor/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="/css/vendor/fullcalendar.css" />

	<link rel="stylesheet" href="/css/default.css" />

	<!-- start: bootstrap theme -->
	<link rel="stylesheet" href="/css/vendor/original.css" />
	<link rel="stylesheet" href="/css/vendor/style.css" id="base-style" />
	<link rel="stylesheet" href="/css/vendor/style-responsive.css" id="base-style-responsive" />
	<!-- end: bootstrap theme -->

	<link rel="stylesheet" href="/css/vendor/bootstrapSwitch.css" />
	<link rel="stylesheet" href="/css/vendor/chosen.css" />
	<link rel="stylesheet" href="/css/validation.css" />
	<link rel="stylesheet" href="/css/app.css" />


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


	<!-- Start Application Script -->
	<script src="/js/main.js"></script>

    <script>
        $(function() {
        	// $("#nav_events").attr('href','#').addClass("disabled");
			var today = new Date();
			var d = today.getDate();
			var m = today.getMonth();
			var y = today.getFullYear();

        	$(".disabled").on('click',function(e){
        		e.PreventDefault();
        	});

		 	$('tbody tr').find('a.action').hide();
			$('tbody tr').hover(
			    function() {
			        $('a.action', this).show();
			    },
			    function() {
			        $('a.action', this).hide();
			    }
			);

			$("#calendar").fullCalendar({
					buttonIcons: { 
						prev: 'circle-triangle-w',
						next: 'circle-triangle-e'
					},
					editable: true,
					header: {
						left:   'prev, next today',
						center: 'title',
					 	right:  'agendaDay, agendaWeek, month'
					},
					buttonText: {
					    prev:     '&lsaquo;', // <
					    next:     '&rsaquo;', // >
					    prevYear: '&laquo;',  // <<
					    nextYear: '&raquo;',  // >>
					    today:    'Today',
					    month:    'Month',
					    week:     'Week',
					    day:      'Day'						
					},
					events: [
						{
							title: 'Mike Birthday',
							start: new Date(2013,9,15)
						},
						{
							title: 'Lacrosse vs Huntington',
							start: new Date(y,m,d,17,30),
							end: new Date(y,m,d,19,30),
							allDay: false
						},
						{
							title: 'Lacrosse @ Newport',
							start: new Date(y,m,d+2,15,30),
							end: new Date(y,m,d+2,17,30),
							allDay: false
						}
					]
			});

         });
    </script>

</head>

<html>

<body id="body">

	<div class="wrapper">
		<div id="userinfo">
			@if ( Auth::check() )
				{{ Gravatar::get( null , false , Auth::user()->email ) }}&nbsp;
				Welcome back <strong>{{ ucwords(Auth::user()->username) }}</strong>&nbsp;&nbsp;
				<i class="icon-user"></i>&nbsp;{{ link_to('logout', 'Logout') }}
			@else
				<i class="icon-user"></i>&nbsp;{{ link_to('login', 'Login') }}
			@endif
		</div>

		<header>
			 <h1> <img src="/img/laravel.png"> {{ $title }}</h1>
		</header>

		<nav>
			<ul ul class="nav nav-tabs">
			  <li class="{{ $title == 'Home' ? 'active' : '' }}"><a href="/">Home</a></li>
			@if(Auth::check())
			  <li class="{{ $title == 'Companies' ? 'active' : '' }}"><a id="nav_companies" href="/companies">Companies</a></li>
			  <li class="{{ $title == 'Contacts' ? 'active' : '' }}"><a id="nav_ccontacts" href="/contacts">Contacts</a></li>
			  <li class="{{ $title == 'Users' ? 'active' : '' }}"><a id="nav_users" href="/users">Users</a></li>

			  <li class="{{ $title == 'Players' ? 'active' : '' }}"><a id="nav_players" href="/players">Players</a></li>

			  <li class="{{ $title == 'Events' ? 'active' : '' }}"><a id="nav_events" href="/events">Events</a></li>
			@endif
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