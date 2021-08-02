@extends('main')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ \URL::to('password') }}" id="form-user" novalidate>
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        Change Your Password
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Current Password</label>
                                    <div class="col-md-5">
                                        <input id="email" type="password" class="form-control" name="old_password" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">New Password</label>
                                    <div class="col-md-5">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Repeat Password</label>
                                    <div class="col-md-5">
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ url('/') }}" class="btn btn-ghost-danger">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@stop
