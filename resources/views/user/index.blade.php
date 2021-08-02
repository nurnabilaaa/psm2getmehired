@extends("main")
@section("content")
    <div class="card">
        <div class="card-header">
            <div class="mt-1 float-left">
                @if($for == 'admin')
                    <strong>List Admin</strong>
                @elseif($for == 'consultant')
                    <strong>List Consultant</strong>
                @elseif($for == 'customer')
                    <strong>List Customer</strong>
                @endif
            </div>
            <div class="float-right" style="display: flex;flex-direction: row;">
                @if($for == 'admin')
                    <a class="btn btn-primary btn-sm" href="{{ url('user/create/admin') }}" style="margin-right: 4px;padding-top: 5px">
                        Add Admin
                    </a>
                @endif
                <button class="btn btn-primary btn-sm grid-btn-excel" type="button" style="margin-right: 4px;">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-cloud-download') }}"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ url()->full() }}" id="form-user" novalidate>
                @if (!empty(request()->get('sort'))) <input id="pub" type="hidden" name="sort" value="{{ request()->get('sort') }}"/> @endif
                @if (!empty(request()->get('direction'))) <input id="pub" type="hidden" name="direction" value="{{ request()->get('direction') }}"/> @endif
                <div class="form-group col-md-4 float-right">
                    <div class="input-group mb-3">
                        <input type="text" name="q" class="form-control" placeholder="" aria-label="" value="{{ request()->get('q') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-hover table-md">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 3%">#</th>
                        <th scope="col" style="width: 28%">@sortablelink('fullname','Fullname')</th>
                        <th scope="col" style="width: 11%">@sortablelink('email','Email')</th>
                        <th scope="col" style="width: 11%">@sortablelink('phone_no','Handphone No')</th>
                        <th scope="col" style="width: 11%;color: #20a8d8">CV</th>
                        <th scope="col" style="width: 11%">@sortablelink('status','Status')</th>
                        <th scope="col" style="width: 9%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td scope="row">
                                @if(!empty(\Request::get('perPage')) && !empty(\Request::get('page')))
                                    {{ (\Request::get('perPage') * (\Request::get('page') - 1)) + ($key + 1) }}
                                @else
                                    {{ $key + 1 }}
                                @endif
                            </td>
                            <td>
                                {{ $user->fullname }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->phone_no }}
                            </td>
                            <td>
                                @if($user->cv_filename != null)
                                    <a href="{{ url('cv/' . $user->cv_filename) }}" target="_blank">Show CV</a>
                                @endif
                            </td>
                            <td>
                                @if($user->enable) Enable @else Disabled @endif
                            </td>
                            <td class="text-center">
                                <div class="buttons">
                                    <a href="{{ url('user/edit/' . $for . '/' . $user->id) }}" class="mr-1">
                                        Edit
                                    </a>
                                    <a href="javascript:void(0)" data-id="{{ $user->id }}" class="text-danger delete">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-left">
                    <form class="form-inline" method="GET" role="form" id="sd">
                        @if (!empty(request()->get('sort'))) <input type="hidden" name="sort" value="{{ request()->get('sort') }}"/> @endif
                        @if (!empty(request()->get('direction'))) <input type="hidden" name="direction" value="{{ request()->get('direction') }}"/> @endif
                        @if (!empty(request()->get('q'))) <input type="hidden" name="q" value="{{ request()->get('q') }}"/> @endif
                        <div class="form-group">
                            <label for="perPage">Papar </label>
                            <select class="form-control" style="margin-left: 10px; padding: 6px;height: 33px" id="perPage" name="perPage">
                                <option value="10" @if(\Request::get('perPage') == '10') selected @endif>10</option>
                                <option value="20" @if(\Request::get('perPage') == '20') selected @endif>20</option>
                                <option value="30" @if(\Request::get('perPage') == '30') selected @endif>30</option>
                                <option value="40" @if(\Request::get('perPage') == '40') selected @endif>40</option>
                                <option value="50" @if(\Request::get('perPage') == '50') selected @endif>50</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="float-right">
                    {{ $users->appends(\Request::except('page'))->render() }}
                </div>
            </div>
        </div>
    </div>

    <form id="form-delete" method="post">
        <input type="hidden" name="_method"/>
        <input type="hidden" name="_token">
    </form>
@stop

@section('page-script')
    <script>
        $(document).ready(function () {
            $('#perPage').on('change', function () {
                $('#sd').submit();
            });

            $('.delete').on('click', function () {
                let id = $(this).attr('data-id');
                swal({
                    title: 'Are you sure?',
                    text: "This record will be deleted!",
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        confirm: {text: 'Yes', className: 'sweet-danger'},
                        cancel: 'No'
                    },
                }).then((willDo) => {
                    if (willDo) {
                        $('input[name="_token"]').val($('meta[name="csrf-token"]').attr('content'));
                        $('input[name="_method"]').val('DELETE');
                        $('#form-delete').attr('action', '{{ \URL::to('invoice') }}/' + id);
                        $('#form-delete').submit();
                    }
                });
            })
        });
    </script>
@append
