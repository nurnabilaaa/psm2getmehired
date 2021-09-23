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
                <form method="POST" action="{{  URL::to('activate/' . $user->id) }}" id="form-activate" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12" style="width: 350px">
                            <h2 class="text-center">Activate Your Account</h2>
                            <p class="text-muted text-center">Enter your preferred password to complete activation process</p>
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
                                <input type="email" class="form-control form-control-user" name="email" value="{{ strtolower($user->email) }}" readonly>
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
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
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
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 text-right" style="margin-left: -5px;">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Activate
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-left">
                            <a href="{{ url('login') }}" class="btn btn-link px-0">< Login</a>
                        </div>
                        <div class="col-6 text-right"></div>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@stop

