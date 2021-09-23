<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        body {
            font: 400 14px/18px Roboto, Noto Sans, Noto Sans JP, Noto Sans KR, Noto Naskh Arabic, Noto Sans Thai, Noto Sans Hebrew, Noto Sans Bengali, sans-serif;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>

<body>
Mr/Mrs {{ strtoupper($name) }},
<br/><br/>
Welcome to GetMe Hired.
<br/><br/>
Please click on link below to activate your account.
<br/><br/>
<a href="{{ $url }}">{{ $url }}</a>
<br/><br/>
Problem to click on link? Try copy and paste to the browser address bar
<br/><br/>
Thanks<br/>
GETME HIRED APP
</body>
</html>
