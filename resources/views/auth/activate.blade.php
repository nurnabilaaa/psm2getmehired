@extends('auth.main')
@section('content')
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('images/logo-qsmart.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Aktifkan Akaun</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Sila masukkan pilihan katalaluan</p>
                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger pl-2 pt-1 pb-1">
                                        {{ e(Session::get('error')) }}
                                    </div>
                                @endif
                                <form method="POST" action="{{  URL::to('activate/' . $user->id) }}" id="form-activate" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Katanama</label>
                                        @if (strpos($user->role, 'PENGURUS HOSPITAL') !== false)
                                            <div data-dx="textbox" data-name="username" data-case="lowercase" data-readonly="true"
                                                 data-value="{{ strtolower($user->email) }}">
                                            </div>
                                        @else
                                            @if($usernameAs->value == 'E-MEL')
                                                <div data-dx="textbox" data-name="username" data-case="lowercase" data-readonly="true"
                                                     data-value="{{ strtolower($user->email) }}">
                                                </div>
                                            @elseif($usernameAs->value == 'NO PEKERJA')
                                                <div data-dx="textbox" data-name="username" data-readonly="true"
                                                     data-value="{{ $user->work_no }}">
                                                </div>
                                            @elseif($usernameAs->value == 'NO KAD PENGENALAN')
                                                <div data-dx="textbox" data-name="username" data-readonly="true"
                                                     data-value="{{ $user->identification_no }}">
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Katalaluan</label>
                                        <div data-dx="textbox" data-name="password" data-mode="password" data-value="" data-validate="true" data-validation-type="required"
                                             data-validation-group="form"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Ulang Katalaluan</label>
                                        <div data-dx="textbox" data-name="retype_password" data-mode="password" data-value="" data-validate="true"
                                             data-validation-type="required,retype_password" data-validation-group="form"></div>
                                    </div>
                                    <div class="form-group float-right">
                                        <a href="{{  URL::to('login') }}" class="btn btn-ghost-danger">Batal</a>
                                        <div data-dx="btn-submit" data-type="default" data-text="Hantar" data-disabled="true" data-validation-group="form"
                                             data-form="form-activate">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; QSMART PPUKM 2020-2021
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
