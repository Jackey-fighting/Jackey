@extends('layouts.default')
@section('title', 'home')

@section('content')
<div class="jumbotron">
	<h1>Hello, Welcome to here.</h1>
	<p class="lead">
		Now, you will see the home of <a href="{{ route('home') }}">jackey.eting site</a>
	</p>
	<p>Everything is begin in here.</p>
	<p>
		<a href="{{ route('signup') }}" class="btn btn-logo btn-danger">sign up</a>
	</p>
</div>
@endsection
