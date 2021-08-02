@extends('main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    Your Profile
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <dl class="row">
                                <dt class="col-sm-2 col-xl-2">Fullname</dt>
                                <dd class="col-sm-10 col-xl-10">: {{ $user->fullname }}</dd>
                                <dt class="col-sm-2 col-xl-2">Email Address</dt>
                                <dd class="col-sm-10 col-xl-10">: <a href="mailto:{{ $user->email }}" target="_blank" class="text-navy">{{ $user->email }}</a></dd>
                                <dt class="col-sm-2 col-xl-2">Handphone No</dt>
                                <dd class="col-sm-10 col-xl-10">: {{ $user->phone_no }}</dd>
                                <dt class="col-sm-2 col-xl-2">Roles</dt>
                                <dd class="col-sm-10 col-xl-10">:
                                    @php $roles = [] @endphp
                                    @foreach($user->roles as $role)
                                        @php array_push($roles, $role->display_name) @endphp
                                    @endforeach
                                    {{ implode(' / ', $roles) }}
                                </dd>
                            </dl>
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-primary" style="height: 33px"
                                        onclick="location.href = '{{ URL::to('profile/edit') }}';">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
