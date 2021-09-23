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
<h2>Welcome to GetMe Hired.</h2>
<br/>
Hello Mr/Mrs {{ strtoupper($name) }},
<br />
<b>It's great to have you on board!</b>
<br/><br/>
You’re on the way to creating a beautiful curriculum vitae, and we’ve got everything you’ll need.
<br/><br/>
Let's get started on how to "WOW" employees out there with your first CV.
<br/><br/>
<a href="{{ $url }}">{{ $url }}</a>
<br/><br/>
Problem to click on link? Try copy and paste to the browser address bar
<br/><br/>
Thanks<br/>
GETME HIRED APP
</body>
</html>
