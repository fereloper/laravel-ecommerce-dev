<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Welcome {{ $name }} !</h2>

		<div>
                    Thanks for creating an account. To complete your registration you need to verify your email address. <br/> 
                    Please click this link to verify your account: <a href="{{ $values["link"] }}">Email Verification</a><br/>
                    OR <br/>
                    You can use direct link: {{ URL::to('http://codewarriors.me/#/user/verify/'.$values["token"].'/'.$values["id"]) }} <br/>
                    Link will expire in 1 day.

                    <p><b>Thanks, <br/><br/>Ergo Warriors Support Team.</b></p>

                    <p>This is an auto system mail. No need to reply this mail.</p>
		</div>
	</body>
</html>
