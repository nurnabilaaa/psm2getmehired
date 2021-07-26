<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
</head>
<body>
<div style="width: 100%;padding:10px;font-family: sans-serif; font-size: 13px;">
    <br/>
    Mr/Mrs {{ strtoupper($name) }}, <br/><br/>
    Please click on link below to reset your password<br/><br/>
    <a href="{{ $url }}">Reset Your Password</a><br/><br/><br/>
    Thank you<br/>
    Getme Hired
</div>
</body>
</html>
