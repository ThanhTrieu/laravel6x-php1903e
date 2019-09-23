<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Demo login</title>
</head>
<body>
	<form action="{{ route('user.login') }}" method="post">
		@csrf
		<label for="user"> username </label>
		<input type="text" id="user" name="user">
		<br><br>
		<label for="pass"> password </label>
		<input type="text" id="pass" name="pass">
		<br><br>
		<button type="submit" name="btnLogin">login</button>
	</form>
</body>
</html>