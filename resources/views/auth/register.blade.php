@extends('auth.main')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-5">
                <div class="text-white d-md-down-none" style="padding-top: 90px">
                    <div class="text-center">
                        <img src="{{ asset('images/g14.jpg') }}" style="width: 450px;margin-right: 20px;border-radius: 40px;"/>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <form method="POST" action="{{ url('register') }}" id="form-register" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12" style="width: 350px">
                            <h2 class="text-center">Register</h2>
                            <p class="text-muted text-center">Please fill in all field and submit</p>
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
                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                       value="{{ old('fullname') }}" autofocus placeholder="Your Name">
{{--                                @error('fullname') <div class="invalid-feedback text-right">{{ $message }}</div> @enderror--}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('icons/free.svg#cil-envelope-closed') }}"></use>
                                    </svg>
                                </span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                       placeholder="Email Address" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('icons/free.svg#cil-phone') }}"></use>
                                    </svg>
                                </span>
                                </div>
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}"
                                       placeholder="Handphone Number" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('icons/free.svg#cil-check') }}"></use>
                                    </svg>
                                </span>
                                </div>
                                <select class="form-control @error('package') is-invalid @enderror" name="package" required>
                                    <option value="">Select Package</option>
                                    <option value="CV Writing" @if(old('package') == 'CV Writing') selected @endif>CV Writing</option>
                                    <option value="CV Templates" @if(old('package') == 'CV Templates') selected @endif>CV Templates</option>
                                </select>
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#packageModal">Show</a>
                                </span>
                                </div>
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
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password"
                                       >
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
                        <div class="col-6">
                            <a href="{{ url('login') }}" class="btn btn-link px-0">< Login</a>
                        </div>
                        <div class="col-6 text-right" style="margin-left: -5px;">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    
    <div class="modal fade" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-info modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Package Detail</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-5">
                            <h3>CV Writing</h3><br/>
                            <h4>RM80</h4><br/>
                            One-off<br/><br/>
                            You Get<br/>
                            + Full writing ATS CV<br/>
                            + Highlight achievement<br/>
                            + Redesign and rewrite<br/>
                            + Secret CV structure<br/>
                            + Free CV Templates<br/>
                            + Editable file<br/>
                            + Mini library access<br/>
                            + Secret checklist<br/>
                        </div>
                        <div class="col-5">
                            <h3>CV Templates</h3><br/>
                            <h4>RM50</h4><br/>
                            One-off<br/><br/>
                            You Get<br/>
                            + 2 ATS CV<br/>
                            + 3 Non ATS CV<br/>
                            + Full guidelines<br/>
                            + Free example<br/>
                            + Secret CV structure<br/>
                            + Secret CV structure<br/>
                            + Editable file<br/>
                            + Mini library access<br/>
                            + Secret checklist<br/>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop
