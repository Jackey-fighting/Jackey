@extends('layouts.default')
@section('title', 'home')

@section('content')
	@if(Auth::check())
		<div class="row">
			<div class="col-md-8">
				<section class="status_form">
					@include('shared._status_form')
				</section>
				<h3>Microblogging List</h3>
				@include('shared._feed')
			</div>
			<aside class="col-md-4">
				<section class="user_info">
					@include('shared._user_info', ['user'=>Auth::user()])
				</section>
			</aside>
		</div>
	@else
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
	@endif
@endsection
