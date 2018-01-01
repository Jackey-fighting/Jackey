@extends('layouts.default')
@section('title', 'Sign in')

@section('content')
	<div class="clo-md-offset-2 col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5>Sign in</h5>
			</div>
			<div class="panel-body">
				@include('shared._errors')

				<form method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="email">email: </label>
						<input type="text" name="email" class="form-controller" value="{{ old('email') }}">
					</div>
					<div class="form-group">
						<label for="password">password: </label>
						<input type="password" name="password" class="form-controller" value="{{ old('password') }}">
					</div>
					<div class="form-group">
						<label><input type="checkbox" name="remember">remember me</label> | 
						<label><a href="{{ route('password.request') }}">forgot password</a></label>
					</div>

					<button class="btn btn-primary" type="submit">sign in</button>
				</form>
				<hr/>
				<p>There is no acount number yet?<a href="{{ route('users.create') }}">sign up</a></p>
			</div>
		</div>
	</div>
@endsection