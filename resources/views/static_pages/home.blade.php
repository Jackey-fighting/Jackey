@extends('layouts.default')
@section('title', 'home')

@section('content')
<div class="jumbotron">
	<h1>Hello, JackeyEting</h1>
	<p class="lead">
		你现在所看到的是<a href="http://www.baidu.com">百度首页</a>
	</p>
	<p>一切，将从这里开始</p>
	<p>
		<a href="{{ route('signup') }}" class="btn btn-logo btn-danger">sign up</a>
	</p>
</div>
@endsection
