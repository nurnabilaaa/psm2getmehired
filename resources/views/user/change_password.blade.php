@extends('main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    Tukar Katalaluan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ \URL::to('password') }}" id="form-user" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Katalaluan Lama</label>
                                    <div class="col-md-5">
                                        <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="old_password" data-mode="password" data-value=""
                                             data-validate="true"
                                             data-validation-type="required" data-validation-group="form">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Katalaluan Baru</label>
                                    <div class="col-md-5">
                                        <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="password" data-mode="password" data-value="" data-validate="true"
                                             data-validation-type="required" data-validation-group="form">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Ulang Katalaluan</label>
                                    <div class="col-md-5">
                                        <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="retype_password" data-mode="password" data-value=""
                                             data-validate="true"
                                             data-validation-type="required,retype_password" data-validation-group="form"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost-danger">Batal</a>
                    <div data-dx="btn-submit" data-type="default" data-text="Hantar" data-disabled="false" data-validation-group="form" data-form="form-user"></div>
                </div>
            </div>
        </div>
    </div>
@stop
