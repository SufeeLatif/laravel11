<!DOCTYPE html>
<html>
<head>
    <title>Confirm Your Account</title>
</head>
<body>
    <p>Hello {{ $name }},</p>
    <p>Thank you for registering with us. Please confirm your account by clicking the link below:</p>
    <p><a href="{{ route('confirm.account', ['code' => $code]) }}">Confirm Your Account</a></p>
    <p>If you did not sign up for this account, please ignore this email.</p>
    <p>Regards,<br>Team Laravel</p>
</body>
</html>
