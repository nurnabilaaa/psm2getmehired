<!DOCTYPE html>
<!-- version v3.0.0 -->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Sistem Penilaian Berkomputer">
    <meta name="author" content="Qbitgroup Software">
    <meta name="keyword" content="Penilaian,Berkomputer,Pentaksiran,PBT,Majlis Daerah">
    <title>{{ config('app.title') }}</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="c-app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        @yield('content')
        <div class="col-6">
            <div class="row">
                <div class="col-6 text-right pt-2" style="height: 200px"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6 text-right pt-2">
                    <span class="font-size: 10pt">Copyright &copy; Getme Hired 2021</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    if (typeof module === 'object') {
        window.module = module;
        module = undefined;
    }
</script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<!--[if IE]><!-->
<script src="{{ asset('js/svgxuse.min.js') }}"></script>
<!--<![endif]-->
<script>
    if (window.module) module = window.module;
</script>
</body>
</html>
