@extends('auth.main')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-5">
                <div class="py-5 text-white d-md-down-none">
                    <div class="text-center">
                        <img src="{{ asset('images/g14.jpg') }}" style="width: 450px;margin-right: 20px;border-radius: 40px;"/>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="text-center">
                    <img src="{{ asset('images/getmehired.png') }}" style="width: 200px; margin-bottom: 15px"/>
                </div>
                <form method="POST" action="{{ url('login') }}" id="form-login" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12" style="width: 350px">
                            <h2 class="text-center">Login</h2>
                            <p class="text-muted text-center">Please enter your username and password</p>
                            @if ($errors->any())
                                <div class="alert alert-danger pl-1 pt-1 pb-1">
                                    <ul class="mt-0 mb-0 pl-1" style="list-style-type:none;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class=" alert alert-danger pl-2 pt-1 pb-1">
                                    {{ e(Session::get('error')) }}
                                </div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success pl-2 pt-1 pb-1">
                                    {{ e(Session::get('success')) }}
                                </div>
                            @endif
                            @if ($paymentMsg != null)
                                <div class="alert @if($paymentStatus == 'success') alert-success @else alert-danger @endif pl-2 pt-1 pb-1">
                                    {{ $paymentMsg }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('icons/free.svg#cil-user') }}"></use>
                                    </svg>
                                </span>
                                </div>
                                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('icons/free.svg#cil-lock-locked') }}"></use>
                                    </svg>
                                </span>
                                </div>
                                <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                       name="password" required
                                       autocomplete="current-password" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input class="form-check-input" type="checkbox" name="remember" style="margin-left: 1px"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="customCheck" style="margin-left: 20px">Remember Me</label>
                        </div>
                        <div class="col-6 text-right" style="margin-left: -5px;">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ url('password/lost') }}" class="btn btn-link px-0">Forgot password?</a>
                        </div>
                        <div class="col-6">
                            <a href="{{ url('register') }}" class="btn btn-link px-0">Create an Account!</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@stop
