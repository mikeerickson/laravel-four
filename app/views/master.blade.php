<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title }}</title>
			{{ Html::linkAsset('/css/default.css') }}
	</head>
	<body>
	
	<div id="header"><h1>{{ $title }}<h1></div>
	
		@yield('container')
		
	</body>
</html>
