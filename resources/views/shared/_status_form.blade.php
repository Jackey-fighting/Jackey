<form action="{{ route('statuses.store') }}" method="POST">
	@include('shared._errors')
	{{ csrf_field() }}
	<textarea rows="3" class="form-controller" cols="80" placeholder="talk someting..." name="content">{{ old('content') }}</textarea>
	<button class="btn btn-primary pull-right" type="submit">release</button>
</form>