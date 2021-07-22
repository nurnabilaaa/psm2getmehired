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
En/Cik/Puan/Dr {{ strtoupper($name) }},
<br/><br/>
Selamat datang ke aplikasi QSmart.
<br/><br/>
@if ($username != null && $username != null)
    Berikut merupakan katanama dan katalaluan anda :
    <br/>
    Katanama : {{ $username }}
    <br/>
    Katalaluan : {{ $password }}
    <br/><br/>
    Jika sekiranya anda ingin menukar kataluan anda, sila klik pada pautan di bawah.
    <br/><br/>
    <a href="{{ $url }}">Ubah Katalaluan</a>
    <br/><br/>
    Jika pautan tersebut bermasalah, salin dan tampal pautan ini ke browser
    <br/>
    {{ $url }}
@else
    Sila klik pada pautan di bawah untuk mengaktifkan akaun anda.
    <br/><br/>
    <a href="{{ $url }}">Aktifkan Akaun</a>
    <br/><br/>
    Jika pautan tersebut bermasalah, salin dan tampal pautan ini ke browser
    <br/>
    {{ $url }}
@endif
<br/><br/>
Terima Kasih<br/>
QSMART PPUKM
</body>
</html>
