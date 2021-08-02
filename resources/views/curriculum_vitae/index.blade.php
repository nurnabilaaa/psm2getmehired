@extends("main")
@section("content")
    <div class="card">
        <div class="card-header">
            <div class="mt-1 float-left">
                <strong>List All Curriculum Vitae</strong>
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
                        <th scope="col" style="width: 10%">@sortablelink('created_at','Date')</th>
                        <th scope="col" style="width: 27%">@sortablelink('fullname','Customer Name')</th>
                        <th scope="col" style="width: 23%">@sortablelink('email','Email')</th>
                        <th scope="col" style="width: 11%">@sortablelink('phone_no','Handphone No')</th>
                        <th scope="col" style="width: 13%">@sortablelink('package','Package')</th>
                        <th scope="col" style="width: 13%">@sortablelink('status','Status')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cvs as $key => $cv)
                        <tr>
                            <td scope="row">
                                @if(!empty(\Request::get('perPage')) && !empty(\Request::get('page')))
                                    {{ (\Request::get('perPage') * (\Request::get('page') - 1)) + ($key + 1) }}
                                @else
                                    {{ $key + 1 }}
                                @endif
                            </td>
                            <td>
                                {{ $cv->created_at->format('d M Y') }}
                            </td>
                            <td>
                                {{ $cv->fullname }}
                            </td>
                            <td>
                                {{ $cv->email }}
                            </td>
                            <td>
                                {{ $cv->phone_no }}
                            </td>
                            <td>
                                {{ $cv->package }}
                            </td>
                            <td>
                                @if($cv->status == 0) Not Upload
                                @elseif($cv->status == 1) Not Pickup
                                @elseif($cv->status == 2) On Progress
                                @elseif($cv->status == 3) Finish
                                @endif
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
                    {{ $cvs->appends(\Request::except('page'))->render() }}
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
        });
    </script>
@append
