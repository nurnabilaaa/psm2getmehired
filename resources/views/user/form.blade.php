@extends('main')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{  isset($user) ? url('user/update/' . $for . '/' . $user->id) : url('user/store') }}" id="form-doctor"
                  enctype="multipart/form-data"
                  novalidate>
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        @if (isset($user)) Update @else Add @endif {{ ucfirst($for) }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="fullname">Fullname</label>
                                    <div class="col-md-7">
                                        <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                               value="{{ \Request::old('fullname', isset($user) ? $user->fullname : null) }}" autofocus placeholder="Your Name"
                                               @if($for == 'consultant' || $for == 'customer') readonly @endif>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="identification_no">Email Address</label>
                                    <div class="col-md-7">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ \Request::old('email', isset($user) ? $user->email : null) }}"
                                               placeholder="Email Address" @if($for == 'consultant' || $for == 'customer') readonly @endif>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="department_id">Handphone No</label>
                                    <div class="col-md-7">
                                        <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no"
                                               value="{{ \Request::old('phone_no', isset($user) ? $user->phone_no : null) }}"
                                               placeholder="Handphone Number" @if($for == 'consultant' || $for == 'customer') readonly @endif>
                                    </div>
                                </div>
                                @if($for == 'consultant')
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="department_id">Consultant Status</label>
                                        <div class="col-md-7">
                                            <div class="col-md-9 col-form-label">
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="consultant-status-1" type="radio" value="1" name="consultant_status"
                                                           @if($user->consultant_status == 1) checked @endif>
                                                    <label class="form-check-label" for="consultant-status-1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="consultant-status-2" type="radio" value="0" name="consultant_status"
                                                           @if($user->consultant_status != 1) checked @endif>
                                                    <label class="form-check-label" for="consultant-status-2">Disable</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($user) && $user->id != Auth::user()->id)
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="department_id">User Status</label>
                                        <div class="col-md-7">
                                            <div class="col-md-9 col-form-label">
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="enable-1" type="radio" value="1" name="enable"
                                                           @if($user->enable == 1) checked @endif>
                                                    <label class="form-check-label" for="enable-1">Enable</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="enable-2" type="radio" value="0" name="enable"
                                                           @if($user->enable != 1) checked @endif>
                                                    <label class="form-check-label" for="enable-2">Disable</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (!isset($user))
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="work_no">Password</label>
                                        <div class="col-md-7">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="email">Repeat Password</label>
                                        <div class="col-md-7">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ url('user/' . $for) }}" class="btn btn-ghost-danger">Cancel</a>
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

@section('page-script')
    <script>
        $(document).ready(function () {
        })
    </script>
@append
