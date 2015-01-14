<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	<div class="welcome">
		{{ $users }}
		<p>{{ Session::get('message') }}</p>

		<form action="/api/v1/user/login" method="POST">
			{{Form::token()}}
			Email: <input type="email" name="email" placeholder="Enter your email" id="email"><br>
			Password: <input type="text" name="password" placeholder="Enter your password" id="password"><br>
			<input type="submit">
		</form>
	</div>
</body>
</html>
