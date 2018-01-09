<!DOCTYPE html>
<html>
<head>
	<meta charset='utf8'>
	<title>Confirm_email</title>
</head>
<body>
<h1>Thanks for you to sign up on Jackey site!</h1>
<p>
	please hit this url to finish signup :
	<a href="{{ route('confirm_email', $user->activation_token) }}">{{ route('confirm_email',$user->activation_token) }}</a>
</p>
<p>If this email it belong to you ,please ignore it.</p>
</body>
</html>