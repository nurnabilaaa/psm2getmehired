@extends('main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    Papar Maklumat Pengguna
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center" style="margin-top: 20px">
                                @if ($user->avatar != null)
                                    <img class="c-avatar-img" src="{{ URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', $user->avatar)) }}" style="width: 242px">
                                @else
                                    <img class="c-avatar-img" src="{{ asset('images/profile/no-picture.png') }}" style="width: 242px">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h5>Maklumat Lengkap</h5>
                            <hr class="mt-1 mb-4">
                            <dl class="row">
                                <dt class="col-sm-3 col-xl-3 pr-0">Nama Penuh <span class="float-right">:</span></dt>
                                <dd class="col-sm-9 col-xl-9 pl-1">{{ $user->fullname }}</dd>
                                @if (strpos(Auth::user()->role, 'DOCTOR') === false)
                                    <dt class="col-sm-3 col-xl-3 pr-0">No Kad Pengenalan <span class="float-right">:</span></dt>
                                    <dd class="col-sm-9 col-xl-9 pl-1">{{ $user->identification_no }}</dd>
                                    <dt class="col-sm-3 col-xl-3 pr-0">No Pekerja <span class="float-right">:</span></dt>
                                    <dd class="col-sm-9 col-xl-9 pl-1">{{ $user->work_no }}</dd>
                                @endif
                                <dt class="col-sm-3 col-xl-3 pr-0">Peranan <span class="float-right">:</span></dt>
                                <dd class="col-sm-9 col-xl-9 pl-1">{{ implode(' / ', json_decode($user->role)) }}</dd>
                                @if (strpos($user->role, 'DOCTOR') !== false)
                                    <dt class="col-sm-3 col-xl-3 pr-0">Hospital <span class="float-right">:</span></dt>
                                    <dd class="col-sm-9 col-xl-9 pl-1">{{ $user->hospital->fullname }}</dd>
                                @endif
                                <dt class="col-sm-3 col-xl-3 pr-0">E-mel <span class="float-right">:</span></dt>
                                <dd class="col-sm-9 col-xl-9 pl-1"><a href="mailto:{{ $user->email }}" target="_blank" class="text-navy">{{ $user->email }}</a></dd>
                                <dt class="col-sm-3 col-xl-3 pr-0">Status <span class="float-right">:</span></dt>
                                <dd class="col-sm-9 col-xl-9 pl-1">{{ $user->enable ? 'AKTIF' : 'TIDAK AKTIF' }}</dd>
                                @if ($user->token != null)
                                    <dt class="col-sm-3 col-xl-3 pr-0">Pautan Reset Katalaluan <span class="float-right">:</span></dt>
                                    <dd class="col-sm-9 col-xl-9 pl-1">
                                        <a id="url" href="{{ env('APP_URL') . 'password/reset/' . $user->token }}" target="_blank">
                                            {{ \URL::to('password/reset/' . $user->token) }}
                                        </a>
                                        <span>
                                                    <a href="javascript:void(0)" class="copy ml-2" data-clipboard-action="copy" data-clipboard-target="#url">(Salin pautan)</a>
                                                </span>
                                    </dd>
                                @endif
                                <dt class="col-sm-3 col-xl-3 pr-0">Pautan Pengaktifan Akaun <span class="float-right">:</span></dt>
                                <dd class="col-sm-9 col-xl-9 pl-1">
                                    <a id="url" href="{{ env('APP_URL') . 'activate/' . $user->id }}" target="_blank">
                                        {{ \URL::to('activate/' . $user->id) }}
                                    </a>
                                    <span>
                                                    <a href="javascript:void(0)" class="copy ml-2" data-clipboard-action="copy" data-clipboard-target="#url">(Salin pautan)</a>
                                                </span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('user.index') }}" class="btn btn-ghost-danger">Batal</a>
                    <button type="button" class="btn btn-sm btn-primary"
                            onclick="location.href = '{{ route('user.edit', [$user->id, 'redirect' => 'user/' . $user->id]) }}';">
                        Kemaskini
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-script')
    <script>
        var clipboard = new ClipboardJS('.copy');
        clipboard.on('success', function (e) {
            $("#toastContainer").dxToast({
                message: 'Pautan telah disalin',
                type: "success",
                width: 280,
                position: {
                    my: "right",
                    at: "top right",
                    offset: '-25 100',
                    of: ".main-content"
                },
                displayTime: 5000,
            });
            $("#toastContainer").dxToast('instance').show();
        });
    
    </script>
@endsection
