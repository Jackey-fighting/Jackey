<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>@yield('title', 'Jackey_Default')</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
	@include('layouts._header')

	<div class="container">
		@yield('content')
	</div>

	@include('layouts._footer')
</body>
</html>