<!DOCTYPE html>
<!-- version v3.0.0 -->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cropper.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/lightslider.min.css') }}">
    <link href="{{ asset('css/free-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.toast.min.css') }}" rel="stylesheet">
    @yield("page-css")
</head>

<body class="c-app c-legacy-theme">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none" style="background-color: #23282c">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h2 class="c-sidebar-brand-full" style="color: white">Getme Hired</h2>
            <h2 class="c-sidebar-brand-minimized ml-3" style="color: white">GH</h2>
            {{--            <img class="c-sidebar-brand-full" src="{{ asset('images/getmehired.png') }}" height="47">--}}
            {{--            <img class="c-sidebar-brand-minimized ml-3" src="{{ asset('images/getmehired.png') }}" width="50" height="20">--}}
        </a>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @php if($menu['menu'] == 'Home') echo 'c-active' @endphp" href="{{ url('/') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/free.svg#cil-speedometer') }}"></use>
                </svg>
                Utama
            </a>
        </li>
        @if (\Laratrust::hasRole('admin'))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link @php if($menu['menu'] == 'admin') echo 'c-active' @endphp" href="{{ url('user/admin') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-user') }}"></use>
                    </svg>
                    Admin
                </a>
            </li>
        @endif
        @if (\Laratrust::hasRole('admin'))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link @php if($menu['menu'] == 'announcement') echo 'c-active' @endphp" href="{{ url('announcement') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-voice-over-record') }}"></use>
                    </svg>
                    Announcement
                </a>
            </li>
        @endif
        @if (\Laratrust::hasRole('admin'))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link @php if($menu['menu'] == 'consultant') echo 'c-active' @endphp" href="{{ url('user/consultant') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-contact') }}"></use>
                    </svg>
                    Consultant
                </a>
            </li>
        @endif
        @if (\Laratrust::hasRole('admin'))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link @php if($menu['menu'] == 'customer') echo 'c-active' @endphp" href="{{ url('user/customer') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-people') }}"></use>
                    </svg>
                    Customer
                </a>
            </li>
        @endif
        @if (\Laratrust::hasRole('admin'))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link @php if($menu['menu'] == 'Curriculum Vitae') echo 'c-active' @endphp" href="{{ route('curriculum-vitae.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-description') }}"></use>
                    </svg>
                    Curriculum Vitae
                </a>
            </li>
        @endif
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/free.svg#cil-headphones') }}"></use>
                </svg>
                Bantuan
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#" target="_blank">
                        <span class="c-sidebar-nav-icon"></span>Manual Pengguna
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ env('SUPPORT_URL') . '/' . env('VERSION') . '/' . substr(SHA1(date('d-m-y H:i:s')), 0, 10) }}" target="_blank">
                        <span class="c-sidebar-nav-icon"></span>Laporkan Masalah Sistem
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link @php if($menu['subMenu'] == 'Mengenai ePenilaian') echo 'c-active' @endphp" href="{{ url('about-us') }}">
                        <span class="c-sidebar-nav-icon"></span> Mengenai Getme Hired
                    </a>
                </li>
            </ul>
        </li>
        @if (\Laratrust::hasRole('customer'))
            <li class="c-sidebar-nav-item mt-auto">
                <a class="c-sidebar-nav-link c-sidebar-nav-link-danger" href="https://coreui.io" target="_top">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-3d') }}"></use>
                    </svg>
                    Apply to be a Consultant
                </a>
            </li>
        @endif
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
<div class="c-wrapper c-fixed-components">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="{{ asset('icons/free.svg#cil-menu') }}"></use>
            </svg>
        </button>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="{{ asset('icons/free.svg#cil-menu') }}"></use>
            </svg>
        </button>
        <ul class="c-header-nav">
            <li class="c-header-nav-item">
            </li>
        </ul>
        <ul class="c-header-nav ml-auto pr-3">
            {{--            <li class="c-header-nav-item dropdown">--}}
            {{--                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">--}}
            {{--                    <svg class="c-icon">--}}
            {{--                        <use xlink:href="{{ asset('icons/free.svg#cil-bell') }}"></use>--}}
            {{--                    </svg>--}}
            {{--                </a>--}}
            {{--                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">--}}
            {{--                    <div class="dropdown-header bg-light"><strong>You have 4 messages</strong></div>--}}
            {{--                    <a class="dropdown-item" href="#">--}}
            {{--                        <div class="message">--}}
            {{--                            <div class="py-3 mfe-3 float-left">--}}
            {{--                                <div class="c-avatar"><img class="c-avatar-img" src="" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>--}}
            {{--                            </div>--}}
            {{--                            <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">Just now</small></div>--}}
            {{--                            <div class="text-truncate font-weight-bold"><span class="text-danger">!</span> Important message</div>--}}
            {{--                            <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>--}}
            {{--                        </div>--}}
            {{--                    </a>--}}
            {{--                    <a class="dropdown-item text-center border-top" href="#"><strong>View all messages</strong></a>--}}
            {{--                </div>--}}
            {{--            </li>--}}
            <ul class="c-header-nav ml-auto">
                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar">
                            @if (\Auth::user()->avatar == null)
                                <img class="c-avatar-img" src="{{ asset('images/profile/no-picture.png') }}">
                            @else
                                <img class="c-avatar-img"
                                     src="{{ URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', Auth::user()->avatar)) }}">
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-header bg-light py-2">
                            <strong>Akaun</strong>
                        </div>
                        <a class="dropdown-item" href="{{ url()->to('profile') }}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('icons/free.svg#cil-user') }}"></use>
                            </svg>
                            Profail
                        </a>
                        <a class="dropdown-item" href="{{ url()->to('password') }}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('icons/free.svg#cil-lock-locked') }}"></use>
                            </svg>
                            Tukar Katalaluan
                        </a>
                        <a class="dropdown-item" href="{{ url()->to('logout') }}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('icons/free.svg#cil-account-logout') }}"></use>
                            </svg>
                            Log Keluar
                        </a>
                    </div>
                </li>
            </ul>
        </ul>
    </header>
    <div class="c-body">
        <main class="c-main">
            <div id="loadPanel"></div>
            <div class="container-fluid">
                @yield("modal")
                <div class="fade-in">
                    @yield("content")
                </div>
            </div>
        </main>
        <footer class="c-footer">
            <div>Copyright &copy; Getme Hired 2021</div>
            <div class="ml-auto w-50">
            </div>
        </footer>
    </div>
</div>
<div id="toastContainer"></div>
<script type="text/javascript">
    if (typeof module === 'object') {
        window.module = module;
        module = undefined;
    }

</script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBatKxUzZXrGuiPzw5bG0kCHS9-ABTMj40"></script>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/cropper.min.js') }}"></script>
<script src="{{ asset('js/clipboard.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/jquery.toast.min.js') }}"></script>
<script src="{{ asset('js/lightslider.min.js') }}"></script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<!--[if IE]><!-->
<script src="{{ asset('js/svgxuse.min.js') }}"></script>
<!--<![endif]-->
@yield("page-script")

@if ($errors->any())
    <?php
    $a = [];
    foreach ($errors->all() as $error) {
        array_push($a, $error);
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Success',
                text: {!! json_encode($a) !!},
                position: 'top-center',
                stack: false,
                showHideTransition: 'slide',
                icon: 'error'
            })
        })

    </script>
@endif

@if (!empty(Session::get('error')))
    @php $a = Session::get('error'); @endphp
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Error',
                text: '{{ $a }}',
                position: 'top-center',
                stack: false,
                showHideTransition: 'slide',
                icon: 'error'
            })
        })

    </script>
@endif

@if (!empty(Session::get('success')))
    @php $a = Session::get('success'); @endphp
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Success',
                text: '{{ $a }}',
                position: 'top-center',
                stack: false,
                showHideTransition: 'slide',
                icon: 'success'
            })
        })

    </script>
@endif
<script>
    if (window.module) module = window.module;

</script>
</body>

</html>
