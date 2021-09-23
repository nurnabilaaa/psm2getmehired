@extends("main")
@section("content")
    <div class="card">
        <div class="card-header">
            <div class="mt-1 float-left">
                <strong>List Announcement</strong>
            </div>
            <div class="float-right" style="display: flex;flex-direction: row;">
                <a class="btn btn-primary btn-sm" href="{{ route('announcement.create') }}" style="margin-right: 4px;padding-top: 5px">
                    Add Announcement
                </a>
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
                        <th scope="col" style="width: 20%">@sortablelink('title','Title')</th>
                        <th scope="col" style="width: 10%">@sortablelink('content_type','Content Type')</th>
                        <th scope="col" style="width: 41%">@sortablelink('content_body','Content Body')</th>
                        <th scope="col" style="width: 13%">@sortablelink('expired_at','Expired Date')</th>
                        <th scope="col" style="width: 13%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($announcements as $key => $announcement)
                        <tr>
                            <td scope="row">
                                @if(!empty(\Request::get('perPage')) && !empty(\Request::get('page')))
                                    {{ (\Request::get('perPage') * (\Request::get('page') - 1)) + ($key + 1) }}
                                @else
                                    {{ $key + 1 }}
                                @endif
                            </td>
                            <td>
                                {{ $announcement->title }}
                            </td>
                            <td>
                                {{ $announcement->content_type }}
                            </td>
                            <td>
                                @if($announcement->content_type == 'text')
                                    {!! $announcement->content_body !!}
                                @else
                                    <img src="{{ asset('images/announcement/' . $announcement->content_body) }}" alt="" width="400px">
                                @endif
                            </td>
                            <td>
                                {{ $announcement->expired_at->format('d M Y') }}
                            </td>
                            <td class="text-center">
                                <div class="buttons">
                                    <a href="{{ route('announcement.edit', $announcement->id) }}" class="mr-1">
                                        Edit
                                    </a>
                                    <a href="javascript:void(0)" data-id="{{ $announcement->id }}" class="text-danger delete">
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
                    {{ $announcements->appends(\Request::except('page'))->render() }}
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
                        $('#form-delete').attr('action', '{{ \URL::to('announcement') }}/' + id);
                        $('#form-delete').submit();
                    }
                });
            })
        });
    </script>
@append
