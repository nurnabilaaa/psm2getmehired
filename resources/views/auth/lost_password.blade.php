@extends('auth.main')
@section('content')
    
    <div class="col-12">
        <div class="card-group">
            <div class="py-5 text-white d-md-down-none">
                <div class="text-center">
                    <img src="{{ asset('images/g14.png') }}"/>
                </div>
            </div>
            <div class="p-4">
                <div class="text-center">
                    <img src="{{ asset('images/logo-qsmart-black.png') }}" style="width: 250px"/>
                </div>
                <form method="POST" action="{{ url('password/lost') }}" id="form-forgot" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12" style="width: 350px">
                            <h2 class="text-center">Forgot Password</h2>
                            <p class="text-muted text-center">E-mel untuk set semula katalaluan akan dihantar kepada anda</p>
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
                                <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="username" data-mode="text" data-case="lowercase" data-placeholder="Katanama"
                                     data-value="" data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{  URL::to('login') }}" class="btn btn-ghost-danger">Batal</a>
                        </div>
                        <div class="col-6 text-right" style="margin-left: -5px;">
                            <div data-dx="btn-submit" data-type="default" data-text="Hantar" data-disabled="true" data-validation-group="form" data-form="form-forgot">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
