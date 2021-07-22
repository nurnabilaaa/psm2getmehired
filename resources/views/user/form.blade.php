@extends('main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    Kemaskini Maklumat Pengguna
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', [$user->id, 'redirect' => request()->get('redirect')]) }}" id="form-user"
                          enctype="multipart/form-data"
                          novalidate>
                        @csrf
                        @if (isset($user)) @method('PUT') @endif
                        <div class="row">
                            <div class="col-md-3">
                                <div class="center" style="margin-top: 20px">
                                    <div id="crop"></div>
                                    <div class="controls" style="margin: 3px auto;width: 100px;">
                                        <div id="profile_pic"></div>
                                        <input type="hidden" name="profile_image"/>
                                        <input type="hidden" name="avatar"
                                               value="{{ \Request::old('avatar', $user->avatar != null ? URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', $user->avatar)) : null) }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h5>Maklumat Lengkap</h5>
                                <hr class="mt-1 mb-4">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="fullname">Nama Penuh</label>
                                    <div class="col-md-10">
                                        <div data-dx="textbox" data-name="fullname" data-mode="text"
                                             data-value="{{  \Request::old('fullname', $user->fullname) }}" data-validate="true"
                                             data-validation-type="required" data-validation-group="form"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="email">E-mel</label>
                                    <div class="col-md-10">
                                        <div data-dx="textbox" data-name="email" data-mode="text"
                                             data-value="{{  \Request::old('email', $user->email) }}" data-validate="true"
                                             data-validation-type="required,email" data-validation-group="form">
                                        </div>
                                    </div>
                                </div>
                                @if (strpos($user->role, 'DOCTOR') !== false)
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="clinic_name">Nama Hospital</label>
                                        <div class="col-md-10">
                                            <div data-dx="textbox" data-name="clinic_name" data-mode="text"
                                                 data-value="{{ \Request::old('clinic_name', isset($user->hospital) ? $user->hospital->fullname : null) }}"
                                                 data-validate="true"
                                                 data-validation-type="required" data-validation-group="form"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="address">Alamat</label>
                                        <div class="col-md-10">
                                            <div data-dx="textbox" data-name="address" data-mode="text"
                                                 data-value="{{ \Request::old('address', isset($user->hospital) ? $user->hospital->address : null) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="postcode">Poskod</label>
                                        <div class="col-md-2">
                                            <div data-dx="textbox" data-name="postcode" data-mode="text"
                                                 data-value="{{ \Request::old('postcode', isset($user->hospital) ? $user->hospital->postcode : null) }}">
                                            </div>
                                        </div>
                                        <label class="col-md-1 col-form-label" for="town">Bandar</label>
                                        <div class="col-md-3">
                                            <div data-dx="textbox" data-name="town" data-mode="text"
                                                 data-value="{{ \Request::old('town', isset($user->hospital) ? $user->hospital->town : null) }}">
                                            </div>
                                        </div>
                                        <label class="col-md-1 col-form-label" for="state">Negeri</label>
                                        <div class="col-md-3">
                                            <div data-dx="textbox" data-name="state" data-mode="text"
                                                 data-value="{{ \Request::old('state', isset($user->hospital) ? $user->hospital->state : null) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="clinic_type">Jenis Hospital</label>
                                        <div class="col-md-2">
                                            <div data-dx="selectbox" data-name="clinic_type" data-source="clinic_type" data-value-exp="id" data-validate="true"
                                                 data-validation-type="required" data-validation-group="form"
                                                 data-value="{{ \Request::old('clinic_type', isset($user->hospital) ? $user->hospital->clinic_type : null) }}">
                                            </div>
                                        </div>
                                        <label class="col-md-1 col-form-label" for="phone_no">Telefon No</label>
                                        <div class="col-md-3">
                                            <div data-dx="textbox" data-name="phone_no" data-mode="text"
                                                 data-value="{{ \Request::old('phone_no', isset($user->hospital) ? $user->hospital->phone_no : null) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="lat">Latitud</label>
                                        <div class="col-md-4">
                                            <div data-dx="textbox" data-name="lat" data-mode="text"
                                                 data-value="{{ \Request::old('lat', isset($user->hospital) ? $user->hospital->lat : null) }}">
                                            </div>
                                        </div>
                                        <label class="col-md-2 col-form-label" for="long">Longitud</label>
                                        <div class="col-md-4">
                                            <div data-dx="textbox" data-name="long" data-mode="text"
                                                 data-value="{{ \Request::old('long', isset($user->hospital) ? $user->hospital->long : null) }}">
                                            </div>
                                        </div>
                                    </div>
                                @elseif (strpos(Auth::user()->role, 'PENTADBIR SISTEM') !== false)
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="roles">Peranan</label>
                                        <div class="col-md-10">
                                            <div data-dx="tagbox" data-name="roles[]" data-source="roles" data-value-exp="id" data-value='{{ \Request::old(' role',
                                                        $user->role) }}' data-validate="true" data-validation-type="required" data-validation-group="form">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Status</label>
                                        <div class="col-md-10">
                                            <div data-dx="radiogroup" data-name="enable" data-source="userStatus" data-value-exp="id" data-layout="horizontal"
                                                 data-value="{{ \Request::old('enable', $user->enable) }}" data-validate="true"
                                                 data-validation-type="required" data-validation-group="form">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="identification_no">No Kad Pengenalan</label>
                                        <div class="col-md-10">
                                            <div data-dx="textbox" data-name="identification_no" data-mode="text"
                                                 data-value="{{  \Request::old('identification_no', $user->identification_no) }}" data-validate="true"
                                                 data-validation-type="required" data-validation-group="form">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="work_no">No Pekerja</label>
                                        <div class="col-md-10">
                                            <div data-dx="textbox" data-name="work_no" data-mode="text"
                                                 data-value="{{  \Request::old('work_no', $user->work_no) }}" data-validate="true"
                                                 data-validation-type="required" data-validation-group="form">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url()->to(request()->get('redirect')) }}" class="btn btn-ghost-danger">Batal</a>
                    <div data-dx="btn-submit" data-type="default" data-text="Simpan" data-disabled="true" data-validation-group="form" data-form="form-user"></div>
                </div>
            </div>
        </div>
    </div>
@stop
