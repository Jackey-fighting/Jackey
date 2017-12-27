@extends('layouts.default')
@section('title', 'sign up')

@section('content')
	<div class="col-md-offset-2 col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5>sign up</h5>
			</div>
			<div class="panel-body">
				@include('shared._errors')

				<form method="POST" action="{{ route('users.store') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="name">name: </label>
						<input type="text" name="name" class="form-controller" value="{{ old('name') }}">
					</div>

					<div class="form-group">
						<label for="email">email: </label>
						<input type="text" name="email" class="form-controller" value="{{ old('email') }}">
					</div>

					<div class="form-group">
						<label for="password">password: </label>
						<input type="password" name="password" class="form-controller" value="{{ old('password') }}">
					</div>

					<div class="form-group">
						<label for="password_confirmation">password_confirmation: </label>
						<input type="password" name="password_confirmation" class="form-controller" value="{{ old('password_confirmation') }}">
					</div>
					<button class="btn btn-primary" type="submit">sign up</button>
				</form>
			</div>
		</div>
	</div>
@endsection