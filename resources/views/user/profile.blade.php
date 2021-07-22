@extends('main')
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="card">
                <div class="card-header text-center">
                    @if ($user->avatar != null)
                        <img class="c-avatar-img" src="{{ URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', $user->avatar)) }}" style="width: 242px">
                    @else
                        <img class="c-avatar-img" src="{{ asset('images/profile/no-picture.png') }}" style="width: 242px">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9">
            <div class="card">
                <div class="card-header">
                    Profail Anda
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3 col-xl-3">Nama Penuh</dt>
                        <dd class="col-sm-9 col-xl-9">: {{ $user->fullname }}</dd>
                        <dt class="col-sm-3 col-xl-3">E-mel</dt>
                        <dd class="col-sm-9 col-xl-9">: <a href="mailto:{{ $user->email }}" target="_blank" class="text-navy">{{ $user->email }}</a></dd>
                        @if (strpos(Auth::user()->role, 'DOCTOR') !== false)
                            <dt class="col-sm-3 col-xl-3">Nama Hospital</dt>
                            <dd class="col-sm-9 col-xl-9">: {{ $user->hospital->fullname }}</dd>
                            <dt class="col-sm-3 col-xl-3">Alamat Hospital</dt>
                            <dd class="col-sm-9 col-xl-9">: {{ $user->hospital->getAddress() }}</dd>
                            <dt class="col-sm-3 col-xl-3">Jenis Hospital</dt>
                            <dd class="col-sm-9 col-xl-9">: {{ $user->hospital->clinic_type }}</dd>
                            <dt class="col-sm-3 col-xl-3">No Telefon</dt>
                            <dd class="col-sm-9 col-xl-9">: {{ $user->hospital->phone_no }}</dd>
                            @if ($user->hospital->lat != null || $user->hospital->long != null)
                                <dt class="col-sm-3 col-xl-3">Google Maps</dt>
                                <dd class="col-sm-9 col-xl-9">:
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#maps"><span
                                                style="margin-left: 4px;">{{ $user->hospital->lat . ',' . $user->hospital->long }}</span></a>
                                </dd>
                            @endif
                        @else
                            <dt class="col-sm-3 col-xl-3">No Kad Pengenalan</dt>
                            <dd class="col-sm-9 col-xl-9">: {{ $user->identification_no }}</dd>
                            <dt class="col-sm-3 col-xl-3">No Pekerja</dt>
                            <dd class="col-sm-9 col-xl-9">: {{ $user->work_no }}</dd>
                            <dt class="col-sm-3 col-xl-3">Peranan</dt>
                            <dd class="col-sm-9 col-xl-9">: {{ implode(' / ', json_decode($user->role)) }}</dd>
                        @endif
                    </dl>
                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-primary" style="height: 33px"
                                onclick="location.href = '{{ URL::to('user/' . $user->id . '/edit?redirect=profile') }}';">
                            Kemaskini
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
