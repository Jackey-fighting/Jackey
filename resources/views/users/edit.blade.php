@extends('layouts.default')
@section('title', 'Edit')

@section('content')
<div class="col-md-offset-2 col-md-8">
	<div class="panel panel-defaul">
		<div class="panel-heading">
			<h5>Update personal data</h5>
		</div>
		<div class="panel-body">
			@include('shared._errors')

			<div class="gravatar_edit">
				<a href="http://gravatar.com/emails" target="_blank">
					<img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar">
				</a>
			</div>

			<form method="POST" action="{{ route('users.update', $user->id) }}">
				{{ method_field('PATCH') }}
				{{ csrf_field() }}

				<div class="form-group">
					<label for="name">name: </label>
					<input type="text" name="name" class="form-controller" value="{{ old('name') }}">
				</div>
				<div class="form-group">
					<label for="email">email: </label>
					<input type="text" name="email" class="form-controller" value="{{ old('email') }}" disabled>
				</div>
				<div class="form-group">
					<label for="password">password: </label>
					<input type="password" name="passwrod" class="form-controller" value="{{ old('password') }}">
				</div>
				<div class="form-group">
					<label for="password_confirmation">password_confirmation: </label>
					<input type="password" name="password_confirmation" class="form-controller" value="{{ old('password_confirmation') }}">
				</div>

				<button type="submit" class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
</div>
@endsection