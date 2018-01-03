@if($user->id !== Auth::user()->id)
<div id="follow_form">
	@if(Auth::user()->isFollowing($user->id))
		<form action="{{ route('followers.destroy', $user->id) }}" method="POST">
			{{  csrf_field() }}
			{{ method_field('DELETE') }}
			<button type="submit" class="btn btn-sm btn-danger">unfollow</button>
		</form>
	@else
		<form action="{{ route('followers.store', $user->id) }}" method="POST">
			{{ csrf_field() }}
			<button type="submit" class="btn btn-sm btn-primary">follow</button>
		</form>
	@endif
</div>
@endif